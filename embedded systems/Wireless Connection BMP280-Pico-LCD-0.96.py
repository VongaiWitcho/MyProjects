


#....................................PS DONT FORGET TO CHANGE WIFI NAME AND PASSWORD..............................................



from machine import Pin, SPI, I2C, PWM
import framebuf
import time
import bmp280
import urequests as rq
import network  # For Wi-Fi connection

# Wi-Fi credentials
WIFI_SSID = ""
WIFI_PASSWORD = ""

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

    def backlight(self, value):  # value: min:0 max:1000
        pwm = PWM(Pin(13))  # Backlight
        pwm.freq(1000)
        if value >= 1000:
            value = 1000
        data = int(value * 65536 / 1000)
        pwm.duty_u16(data)

    def Init(self):
        self.reset()
        self.backlight(1000)
        self.write_cmd(0x11)
        time.sleep(0.12)
        self.write_cmd(0x21)
        self.write_cmd(0x21)

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


# **BMP280 Sensor Setup**
i2c = I2C(1, scl=Pin(7), sda=Pin(6))
sensor = bmp280.BMP280(i2c)

# **OpenWeatherMap Setup**
API_KEY = ""
CITY = "London"
WEATHER_URL = f"http://api.openweathermap.org/data/2.5/weather?q={CITY}&appid={API_KEY}&units=metric"

# Initialize LCD
lcd = LCD_0inch96()
lcd.fill(BLACK)

# Wi-Fi Connection Function
def connect_to_wifi():
    wlan = network.WLAN(network.STA_IF)
    wlan.active(True)
    if not wlan.isconnected():
        print(f"Connecting to Wi-Fi network {WIFI_SSID}...")
        wlan.connect(WIFI_SSID, WIFI_PASSWORD)
        while not wlan.isconnected():
            time.sleep(1)
            print("Waiting for Wi-Fi connection...")
    print("Connected to Wi-Fi")
    print(f"IP Address: {wlan.ifconfig()[0]}")

# Fetch temperature from OpenWeatherMap
def get_openweather_temp():
    try:
        response = rq.get(WEATHER_URL)
        if response.status_code != 200:
            print(f"HTTP Error: {response.status_code}")
            return None
        data = response.json()
        response.close()
        return data['main']['temp']
    except Exception as e:
        print("Error fetching weather data:", e)
        return None

# Main loop to display temperatures
try:
    connect_to_wifi()  # Connect to Wi-Fi before starting
    while True:
        # Fetch local temperature from BMP280 sensor
        my_temp = sensor.temperature

        # Fetch weather data from OpenWeatherMap
        web_temp = get_openweather_temp()

        # Display atmospheric temperature on the shell
        print(f"Atmospheric Temperature (BMP280): {my_temp:.2f} °C")
        if web_temp is not None:
            print(f"Web Temperature (OpenWeatherMap): {web_temp:.2f} °C")
        else:
            print("Web Temperature: Error fetching data")

        # Clear LCD display
        lcd.fill(BLACK)

        # Update LCD display
        lcd.text("Temp Monitor", 10, 5, GREEN)
        lcd.text(f"My Temp: {my_temp:.2f} C", 10, 25, GREEN)
        if web_temp is not None:
            lcd.text(f"Web Temp: {web_temp:.2f} C", 10, 45, GREEN)
        else:
            lcd.text("Web Temp: Error", 10, 45, RED)

        lcd.display()

        # Wait 10 seconds before refreshing
        time.sleep(10)

except KeyboardInterrupt:
    print("Program terminated by user.")






