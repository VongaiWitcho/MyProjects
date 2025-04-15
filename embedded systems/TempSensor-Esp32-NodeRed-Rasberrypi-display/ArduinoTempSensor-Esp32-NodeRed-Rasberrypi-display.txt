#include <WiFi.h>
#include <PubSubClient.h>
#include <DHT.h>

#define DHTPIN 4          // GPIO where the DHT11 is connected
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// Wi-Fi credentials
const char* ssid = "Galaxy A12 349C";
const char* password = "vongisto";

// MQTT Broker details
const char* mqtt_server = "test.mosquitto.org";  // Change this to your Mosquitto broker IP
const int mqtt_port = 1883;  
const char* mqtt_topic = "esp32/temperature";

// Create Wi-Fi and MQTT client objects
WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
    Serial.begin(115200);
    dht.begin();

    // Connect to Wi-Fi
    WiFi.begin(ssid, password);
    Serial.print("Connecting to Wi-Fi...");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("Connected to Wi-Fi!");

    // Connect to MQTT Broker
    client.setServer(mqtt_server, mqtt_port);
    reconnect();
}

void loop() {
    if (!client.connected()) {
        reconnect();
    }
    client.loop();

    float temperature = dht.readTemperature();  // Read temperature (Celsius)

    if (isnan(temperature)) {
        Serial.println("Failed to read from DHT sensor!");
        return;
    }

    // Convert temperature to a string and publish to MQTT
    String tempStr = String(temperature);
    client.publish(mqtt_topic, tempStr.c_str());
    Serial.println("Published temperature: " + tempStr);

    delay(2000);  // Publish every 2 seconds
}

// Reconnect function for MQTT
void reconnect() {
    while (!client.connected()) {
        Serial.print("Connecting to MQTT...");
        if (client.connect("ESP32Client")) {
            Serial.println("Connected to MQTT!");
        } else {
            Serial.print("Failed, rc=");
            Serial.print(client.state());
            Serial.println(" Retrying in 5 seconds...");
            delay(5000);
        }
    }
}
