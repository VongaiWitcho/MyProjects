from machine import Pin, SPI, Timer
from utime import sleep
import sys

# Segment Pin Mapping (SPI)
RCLK = 9    # Latch pin
SCK = 10     # Clock pin
MOSI = 11    # Data pin

# Segment Select for 8 segments
LED_1 = 0xFE  # Direction C/A (1st Segment)
LED_2 = 0xFD  # Direction C/A (2nd Segment)
LED_3 = 0xFB  # Tens of total rotations (3rd Segment)
LED_4 = 0xF7  # Units of total rotations (4th Segment)
DOT = 0x80    # Dot for decimal point

# Segment code for digits (0-9)
SEG8codes = [
    0x3F, 0x06, 0x5B, 0x4F, 0x66, 0x6D, 0x7D, 0x07,
    0x7F, 0x6F, 0x77, 0x7C, 0x39, 0x5E, 0x79, 0x71
]  # 0-9

# Directional display codes (C for Clockwise, A for Anti-clockwise)
# Swap the values of "C" and "A" to correct the display
SEG8codes_dict = {
    "C": 0x39,  # Now "C" is Clockwise (C)
    "A": 0x77   # Now "A" is Anti-clockwise (A)
}

class LED_8SEG_DISPLAY:
    def __init__(self):
        self.rclk = Pin(RCLK, Pin.OUT)
        self.spi = SPI(1, baudrate=1000000, polarity=0, phase=0, sck=Pin(SCK), mosi=Pin(MOSI))
    
    def write_cmd(self, Num, Seg):
        self.rclk.value(1)  # Disable latch to start SPI transfer
        self.spi.write(bytearray([Num]))  # Send segment number (address)
        self.spi.write(bytearray([Seg]))  # Send segment data (code for digit/letter)
        self.rclk.value(0)  # Enable latch to update the segment display
        sleep(0.002)  # Wait for a small delay before updating the next segment
        self.rclk.value(1)  # Ensure latch is enabled after SPI transfer

# Rotary Encoder Pins
clk = Pin(0, Pin.IN, Pin.PULL_UP)
dt = Pin(1, Pin.IN, Pin.PULL_UP)

# Variables to track rotations
cw_count = 0  # Clockwise full rotations
ccw_count = 0  # Counterclockwise full rotations
rotation_direction = "C"  # Default direction (C for Clockwise)

# Timer object for sending data every 10 seconds
timer = Timer()

# Variables for debouncing
last_clk_state = clk.value()  # Previous state of the CLK pin
debounce_time = 0.01  # Debounce time (10ms)

# Initialize the 8-segment display object
DISPLAY = LED_8SEG_DISPLAY()

# Function to update the display
def update_display():
    global rotation_direction, cw_count, ccw_count

    # Display rotation direction on first two segments
    DISPLAY.write_cmd(LED_1, SEG8codes_dict[rotation_direction])  # 'C' or 'A' on 1st segment
    DISPLAY.write_cmd(LED_2, 0x00)  # Blank for 2nd segment (optional)

    # Display total rotations on last two segments
    total_rotations = cw_count + ccw_count
    tens = (total_rotations // 10) % 10
    units = total_rotations % 10
    DISPLAY.write_cmd(LED_3, SEG8codes[tens])  # Tens digit on 3rd segment
    DISPLAY.write_cmd(LED_4, SEG8codes[units])  # Units digit on 4th segment

# Rotary Encoder Interrupt Handler
def encoder_interrupt(pin):
    global cw_count, ccw_count, rotation_direction, last_clk_state

    # Get current state of the CLK pin
    clk_state = clk.value()
    
    # Check if the CLK pin state has changed (debouncing)
    if clk_state != last_clk_state:
        last_clk_state = clk_state
        sleep(debounce_time)  # Debounce the encoder signal
        
        dt_state = dt.value()
        
        # If direction has changed, reset the count to zero immediately
        if clk_state != dt_state:  # Clockwise rotation
            if rotation_direction != "C":
                # Reset counter for previous direction immediately when direction changes
                ccw_count = 0  # Reset counterclockwise count
                rotation_direction = "C"  # Set direction to Clockwise
        else:  # Counterclockwise rotation
            if rotation_direction != "A":
                # Reset counter for previous direction immediately when direction changes
                cw_count = 0  # Reset clockwise count
                rotation_direction = "A"  # Set direction to Anti-clockwise

        # Increment the count in the current direction
        if rotation_direction == "C":
            cw_count += 1
        else:
            ccw_count += 1

        # Ensure the count doesn't exceed 99
        if cw_count >= 100:
            cw_count = 0  # Reset clockwise count if it exceeds 99
        if ccw_count >= 100:
            ccw_count = 0  # Reset counterclockwise count if it exceeds 99

# Initialize Rotary Encoder Interrupt
clk.irq(trigger=Pin.IRQ_RISING | Pin.IRQ_FALLING, handler=encoder_interrupt)

# Timer callback function to send data to PC every 10 seconds
def send_data(timer):
    print(f"Total C: {cw_count}, Total A: {ccw_count}")

# Set timer to call the send_data function every 10 seconds
timer.init(period=10000, mode=Timer.PERIODIC, callback=send_data)

# Main Loop
while True:
    update_display()  # Continuously update the display
    sleep(0.01)  # Small delay to prevent overload on the MCU
