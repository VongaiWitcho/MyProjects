import network
import time
import ubinascii
from umqtt import MQTTClient
import machine

# WiFi credentials
SSID = "Galaxy A12 349C"
PASSWORD = "vongisto"

# MQTT broker details
BROKER = "test.mosquitto.org"
TOPIC = "esp32/temperature"

# UART Setup for Nextion (TX=8, RX=9)
uart = machine.UART(1, baudrate=9600, tx=8, rx=9)

# Store temperature values for graph
temperature_values = []
MAX_POINTS = 20  # Number of points in the graph

# Connect to WiFi
def connect_wifi():
    wlan = network.WLAN(network.STA_IF)
    wlan.active(True)
    if not wlan.isconnected():
        print("Connecting to WiFi...")
        wlan.connect(SSID, PASSWORD)
        while not wlan.isconnected():
            pass  # Wait until connected
    print("Connected to WiFi, IP address:", wlan.ifconfig()[0])

# Send a command to the Nextion display
def send_to_nextion(command):
    full_command = command.encode() + b'\xff\xff\xff'  # Append Nextion end sequence
    uart.write(full_command)
    time.sleep(0.1)  # Give Nextion time to process the command

# Update temperature display
def update_temperature_display(temp):
    send_to_nextion(f't0.txt="Temp: {temp:.1f}°C"')  # Update text field for temperature

# Update Nextion graph dynamically
def update_graph(temp):
    global temperature_values
    if len(temperature_values) >= MAX_POINTS:
        temperature_values.pop(0)  # Remove oldest value
    temperature_values.append(int(temp))  # Store integer value

    send_to_nextion("cle 2")  # Clear the correct graph component (ID: 2)

    for value in temperature_values:
        send_to_nextion(f"add 2,0,{value}")  # Add point to the correct graph (w0)

# MQTT callback function
def on_message(topic, msg):
    try:
        temperature = float(msg.decode())  # Convert message to float
        print(f"Temperature received: {temperature}°C")

        # Update Nextion Display & Graph
        update_temperature_display(temperature)
        update_graph(temperature)

    except ValueError:
        print("Error: Received non-numeric data")

# Connect to MQTT broker
def connect_mqtt():
    client_id = ubinascii.hexlify(network.WLAN().config('mac')).decode()
    client = MQTTClient(client_id, BROKER)
    client.set_callback(on_message)
    client.connect()
    print(f"Connected to MQTT broker at {BROKER}")
    client.subscribe(TOPIC, qos=1)  # Subscribe with QoS 1 for better delivery
    return client

# Main loop
def main():
    connect_wifi()
    client = connect_mqtt()

    while True:
        try:
            client.check_msg()  # Check for new MQTT messages
            time.sleep(0.1)  # Reduced delay to 100 ms for faster updates
        except OSError as e:
            print("Error:", e)
            time.sleep(5)
            machine.reset()  # Restart on error

# Run the script
main()
