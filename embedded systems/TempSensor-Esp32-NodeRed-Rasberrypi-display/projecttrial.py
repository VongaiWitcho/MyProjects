C:\Users\user\AppData\Roaming\Nextion Editor\work\a-2025219114715942\output

import network
import time
import ubinascii
from umqtt import MQTTClient

# WiFi credentials
SSID = "UPC4636042_2.4"
PASSWORD = "vUcyTbn43xru"

# MQTT broker details (replace with your broker's IP)
BROKER = "test.mosquitto.org"  # Change to your MQTT broker IP (e.g., your PC or cloud broker)
TOPIC = "esp32/temperature"  # MQTT topic

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

# MQTT callback function for receiving messages
def on_message(topic, msg):
    print(f"Received message on {topic.decode()}: {msg.decode()}")

# Connect to MQTT broker
def connect_mqtt():
    client_id = ubinascii.hexlify(network.WLAN().config('mac')).decode()
    client = MQTTClient(client_id, BROKER)
    client.set_callback(on_message)
    client.connect()
    print(f"Connected to MQTT broker at {BROKER}")
    client.subscribe(TOPIC)
    return client

# Main loop
def main():
    connect_wifi()
    client = connect_mqtt()

    while True:
        try:
            client.check_msg()  # Check for new MQTT messages
            time.sleep(1)
        except OSError as e:
            print("Error:", e)
            time.sleep(5)
            machine.reset()  # Restart on error

# Run the script
main()
