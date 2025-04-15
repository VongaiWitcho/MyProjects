from machine import Pin
import utime


button1 = Pin(6, Pin.IN, Pin.PULL_DOWN) 
reset_button = Pin(7, Pin.IN, Pin.PULL_DOWN)  
built_in_led = Pin(25, Pin.OUT)  


def wait_for_release(pin):
    while pin.value() == 1:  
        pass


while True:
    if button1.value() == 1:  
        print("1st pressed.")
        built_in_led.value(1)  
        wait_for_release(button1)  
        print("1st released.LED turns off after 3 seconds.")
        utime.sleep(3)  
        built_in_led.value(0) 

    if reset_button.value() == 1:  
        print("Reset pressed.")
        wait_for_release(reset_button)  
        reset_message = input("Enter a reset message: ")  
        print(f"Reset message: {reset_message}")
        built_in_led.value(0) 
        print("Script reset complete.")

