from machine import ADC, Pin
from utime import sleep, ticks_ms

# Initialize joystick (Y-axis) and button
joy_Y = ADC(26)  # Y-axis of the joystick
joy_switch = Pin(15, Pin.IN, Pin.PULL_UP)

# LED pins for the bargraph
led_pins = [Pin(i, Pin.OUT) for i in range(2, 10)]

# Function to update the bargraph LEDs
def update_bargraph(position):
    for i, led in enumerate(led_pins):
        led.value(1 if i == position else 0)

# Function to clear the bargraph LEDs
def clear_bargraph():
    for led in led_pins:
        led.value(0)

# Initialize variables
current_position = 0  # Start with the first LED
bar_on = True  # Bargraph is initially on
joystick_locked = False  # Lock/unlock joystick movement
button_pressed_time = None  # Track when the button was pressed
long_press_duration = 1000  # Duration (ms) to detect a long press
debounce_delay = 200  # Delay to debounce joystick movements

# Main loop
while True:
    # Read joystick Y-axis value
    joy_value = joy_Y.read_u16()

    # Handle joystick movement if not locked and bargraph is on
    if not joystick_locked and bar_on:
        if joy_value > 35000 and current_position < len(led_pins) - 1:  # Move down
            current_position += 1
            sleep(debounce_delay / 1000.0)  # Debounce delay
        elif joy_value < 3000 and current_position > 0:  # Move up
            current_position -= 1
            sleep(debounce_delay / 1000.0)  # Debounce delay

        # Update the bargraph
        update_bargraph(current_position)

    # Check for button press
    if joy_switch.value() == 0:  # Button pressed
        if button_pressed_time is None:  # First press detection
            button_pressed_time = ticks_ms()

    else:  # Button released
        if button_pressed_time is not None:  # Button was previously pressed
            press_duration = ticks_ms() - button_pressed_time

            if press_duration >= long_press_duration:
                # Long press: Toggle bargraph on/off
                bar_on = not bar_on
                if not bar_on:
                    clear_bargraph()
                else:
                    update_bargraph(current_position)
                print(f"Bargraph {'on' if bar_on else 'off'} (long press).")

            else:
                # Short press: Toggle joystick lock/unlock
                joystick_locked = not joystick_locked
                print(f"Joystick {'locked' if joystick_locked else 'unlocked'} (short press).")

            # Reset button press time
            button_pressed_time = None

    # Delay for stability
    sleep(0.1)
