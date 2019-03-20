let Weather = {
  location: "",
  sunrise: undefined,
  sunset: undefined,
  now: { temp: 0, weather: "" },
  forecast: [
    { temp: 0, weather: "", hour: "" },
    { temp: 0, weather: "", hour: "" },
    { temp: 0, weather: "", hour: "" },
    { temp: 0, weather: "", hour: "" },
    { temp: 0, weather: "", hour: "" }
  ]
};
const wiIcons = {
  "01d": "wi-day-sunny",
  "01n": "wi-night-clear",
  "02d": "wi-day-sunny-overcast",
  "02n": "wi-night-alt-partly-cloudy",
  "03d": "wi-day-cloudy",
  "03n": "wi-night-alt-cloudy",
  "04d": "wi-day-cloudy-high",
  "04n": "wi-night-alt-cloudy-high",
  "09d": "wi-day-sprinkle",
  "09n": "wi-night-alt-sprinkle",
  "10d": "wi-day-rain",
  "10n": "wi-night-alt-rain",
  "11d": "wi-day-thunderstorm",
  "11n": "wi-night-alt-thunderstorm",
  "13d": "wi-day-snow",
  "13n": "wi-night-alt-snow",
  "50d": "wi-day-fog",
  "50n": "wi-night-fog"
};

function truncateDecimal(num) {
  let ret = new String(num).split(".");
  if (ret.length > 1) ret = ret[0] + "." + ret[1][0];
  else ret = ret[0];
  return ret;
}

const getLocation = (options = {}) =>
  new Promise(function(resolve, reject) {
    if (navigator.geolocation)
      return navigator.geolocation.getCurrentPosition(resolve, reject, options);
    else reject();
  });

function updateWeather(json) {
  const isDay =
    new Date(json.sys.sunrise * 1000).getHours() < new Date().getHours() &&
    new Date().getHours() < new Date(json.sys.sunset * 1000).getHours();

  Weather = {
    ...Weather,
    location: json.name,
    isDay,
    now: {
      temp: json.main.temp,
      weather: json.weather[0].icon
    }
  };
}

const toAmPm = hour24 =>
  hour24 >= 12
    ? (hour24 === 12 ? hour24 : hour24 - 12) + "PM"
    : (hour24 === 0 ? 12 : hour24) + "AM";

const updateForecast = json =>
  // get the weather until end of Weather.forecast is reached
  json.list.every(
    ({ main: { temp }, weather: [{ icon: weather }], dt_txt: time }, index) => {
      Weather.forecast[index] = {
        temp,
        weather,
        hour: toAmPm(new Date(time).getHours())
      };
      return index < Weather.forecast.length - 1;
    }
  );

// URL for weather API
const weatherURL = (lat, lon) =>
  `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=fc9c2f0009a8329f2ac436eca2267b63`;
// Get the current weather
const getWeather = (lat, lon) =>
  fetch(weatherURL(lat, lon)).then(response => response.json());

// URL for forecast API
const forecastURL = (lat, lon) =>
  `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&units=metric&appid=fc9c2f0009a8329f2ac436eca2267b63`;
// Get the forecast, contains data for 5 days (I think)
const getForecast = (lat, lon) =>
  fetch(forecastURL(lat, lon)).then(response => response.json());

function updateScreen() {
  let wc = Weather.now.weather,
    icon = document.querySelector("div.infoDesktop > i"),
    temperature = document.querySelector("div.infoDesktop > span.degree"),
    location = document.querySelector("div.infoDesktop > span"),
    hours = document.getElementsByClassName("hour");
  icon.classList = "wi" + " " + wiIcons[wc];
  location.textContent = Weather.location;
  temperature.textContent = truncateDecimal(Weather.now.temp);
}

getLocation().then(pos =>
  getWeather(pos.coords.latitude, pos.coords.longitude)
    .then(
      r =>
        updateWeather(r) |
        getForecast(pos.coords.latitude, pos.coords.longitude)
          .then(r => updateForecast(r))
          .then(() => updateScreen())
    )
    .catch(r => console.log(r))
);
