from machine import Pin, SPI, PWM, ADC
import framebuf
import time

# Color definitions (BGR format)
RED = 0x00F8
GREEN = 0xE007
BLUE = 0x1F00
WHITE = 0xFFFF
BLACK = 0x0000

# LCD class for Pico-LCD-0.96
class LCD_0inch96(framebuf.FrameBuffer):
    def __init__(self):
        self.width = 160
        self.height = 80
        self.cs = Pin(9, Pin.OUT)
        self.rst = Pin(12, Pin.OUT)
        self.cs(1)
        self.spi = SPI(1, 10000_000, polarity=0, phase=0, sck=Pin(10), mosi=Pin(11), miso=None)
        self.dc = Pin(8, Pin.OUT)
        self.dc(1)
        self.buffer = bytearray(self.height * self.width * 2)
        super().__init__(self.buffer, self.width, self.height, framebuf.RGB565)
        self.Init()
        self.SetWindows(0, 0, self.width - 1, self.height - 1)

    def reset(self):
        self.rst(1)
        time.sleep(0.2)
        self.rst(0)
        time.sleep(0.2)
        self.rst(1)
        time.sleep(0.2)

    def write_cmd(self, cmd):
        self.dc(0)
        self.cs(0)
        self.spi.write(bytearray([cmd]))
        self.cs(1)

    def write_data(self, buf):
        self.dc(1)
        self.cs(0)
        self.spi.write(bytearray([buf]))
        self.cs(1)

    def backlight(self, value):
        pwm = PWM(Pin(13))
        pwm.freq(1000)
        if value >= 1000:
            value = 1000
        data = int(value * 65536 / 1000)
        pwm.duty_u16(data)

    def Init(self):
        self.reset()
        self.backlight(10000)
        self.write_cmd(0x11)
        time.sleep(0.12)
        self.write_cmd(0x21)
        self.write_cmd(0x21)
        self.write_cmd(0xB1)
        self.write_data(0x05)
        self.write_data(0x3A)
        self.write_data(0x3A)
        self.write_cmd(0xB2)
        self.write_data(0x05)
        self.write_data(0x3A)
        self.write_data(0x3A)
        self.write_cmd(0xB3)
        self.write_data(0x05)
        self.write_data(0x3A)
        self.write_data(0x3A)
        self.write_data(0x05)
        self.write_data(0x3A)
        self.write_data(0x3A)
        self.write_cmd(0xB4)
        self.write_data(0x03)
        self.write_cmd(0xC0)
        self.write_data(0x62)
        self.write_data(0x02)
        self.write_data(0x04)
        self.write_cmd(0xC1)
        self.write_data(0xC0)
        self.write_cmd(0xC2)
        self.write_data(0x0D)
        self.write_data(0x00)
        self.write_cmd(0xC3)
        self.write_data(0x8D)
        self.write_data(0x6A)
        self.write_cmd(0xC4)
        self.write_data(0x8D)
        self.write_data(0xEE)
        self.write_cmd(0xC5)
        self.write_data(0x0E)
        self.write_cmd(0xE0)
        self.write_data(0x10)
        self.write_data(0x0E)
        self.write_data(0x02)
        self.write_data(0x03)
        self.write_data(0x0E)
        self.write_data(0x07)
        self.write_data(0x02)
        self.write_data(0x07)
        self.write_data(0x0A)
        self.write_data(0x12)
        self.write_data(0x27)
        self.write_data(0x37)
        self.write_data(0x00)
        self.write_data(0x0D)
        self.write_data(0x0E)
        self.write_data(0x10)
        self.write_cmd(0xE1)
        self.write_data(0x10)
        self.write_data(0x0E)
        self.write_data(0x03)
        self.write_data(0x03)
        self.write_data(0x0F)
        self.write_data(0x06)
        self.write_data(0x02)
        self.write_data(0x08)
        self.write_data(0x0A)
        self.write_data(0x13)
        self.write_data(0x26)
        self.write_data(0x36)
        self.write_data(0x00)
        self.write_data(0x0D)
        self.write_data(0x0E)
        self.write_data(0x10)
        self.write_cmd(0x3A)
        self.write_data(0x05)
        self.write_cmd(0x36)
        self.write_data(0xA8)
        self.write_cmd(0x29)

    def SetWindows(self, Xstart, Ystart, Xend, Yend):
        Xstart = Xstart + 1
        Xend = Xend + 1
        Ystart = Ystart + 26
        Yend = Yend + 26
        self.write_cmd(0x2A)
        self.write_data(0x00)
        self.write_data(Xstart)
        self.write_data(0x00)
        self.write_data(Xend)
        self.write_cmd(0x2B)
        self.write_data(0x00)
        self.write_data(Ystart)
        self.write_data(0x00)
        self.write_data(Yend)
        self.write_cmd(0x2C)

    def display(self):
        self.SetWindows(0, 0, self.width - 1, self.height - 1)
        self.dc(1)
        self.cs(0)
        self.spi.write(self.buffer)
        self.cs(1)


# Function to map joystick values to servo angles
def map_range(value, in_min, in_max, out_min, out_max):
    return int((value - in_min) * (out_max - out_min) / (in_max - in_min) + out_min)


# Initialize LCD
lcd = LCD_0inch96()
lcd.fill(BLACK)

# Initialize joystick and servo
joystick_x = ADC(Pin(26))  # X-axis connected to GP26
joystick_y = ADC(Pin(27))  # Y-axis connected to GP27
joystick_button = Pin(28, Pin.IN, Pin.PULL_UP)  # Button connected to GP28
servo = PWM(Pin(16))  # Servo signal connected to GP16
servo.freq(50)  # Servo operates at 50Hz

# Function to set servo angle
def set_servo_angle(angle):
    # Map the angle (0-180) to servo duty cycle (2500-9000)
    duty = map_range(angle, 0, 180, 2500, 9000)
    servo.duty_u16(duty)


# Main loop
current_angle = 90  # Start at the default 90 degrees
last_y_axis = 0  # To keep track of joystick Y-axis movements
last_x_axis = 0  # To keep track of joystick X-axis movements

# Variables for debouncing joystick presses
x_axis_pressed = False
y_axis_pressed = False

try:
    while True:
        # Take user input for the target angle
        try:
            target_angle = int(input("Enter target servo angle (0-180): "))
            if target_angle < 0 or target_angle > 180:
                print("Please enter a valid angle between 0 and 180.")
                continue
        except ValueError:
            print("Invalid input. Please enter a number.")
            continue

        set_servo_angle(current_angle)  # Move servo to initial position

        while True:
            joystick_x_value = joystick_x.read_u16()  # Read joystick X-axis
            joystick_y_value = joystick_y.read_u16()  # Read joystick Y-axis

            # Handle X-axis press and release (increment or decrement by 1 degree)
            if joystick_x_value < 20000 and not x_axis_pressed:  # Joystick moved left
                current_angle = max(0, current_angle - 1)
                x_axis_pressed = True  # Mark that X-axis was pressed
            elif joystick_x_value > 45000 and not x_axis_pressed:  # Joystick moved right
                current_angle = min(180, current_angle + 1)
                x_axis_pressed = True  # Mark that X-axis was pressed
            elif joystick_x_value > 20000 and joystick_x_value < 45000:
                x_axis_pressed = False  # Reset when joystick is in neutral position

            # Handle Y-axis press and release (increment or decrement by 10 degrees)
            if joystick_y_value < 20000 and not y_axis_pressed:  # Joystick moved down
                current_angle = max(0, current_angle - 10)
                y_axis_pressed = True  # Mark that Y-axis was pressed
            elif joystick_y_value > 45000 and not y_axis_pressed:  # Joystick moved up
                current_angle = min(180, current_angle + 10)
                y_axis_pressed = True  # Mark that Y-axis was pressed
            elif joystick_y_value > 20000 and joystick_y_value < 45000:
                y_axis_pressed = False  # Reset when joystick is in neutral position

            # Update LCD
            lcd.fill(BLACK)
            lcd.text(f"Target: {target_angle}", 10, 10, GREEN)
            lcd.text(f"Current: {current_angle}", 10, 30, GREEN)
            lcd.display()

            set_servo_angle(current_angle)  # Update servo position

            if abs(current_angle - target_angle) <= 1:  # Check if target is reached
                print("Target angle reached!")
                break

            time.sleep(0.1)

except KeyboardInterrupt:
    print("Program stopped by user.")

