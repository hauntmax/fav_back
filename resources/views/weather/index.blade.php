<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Виджет погоды и времени</title>
<style>
  body { font-family: sans-serif; color: black; text-align: center; }
  #time { font-size: 3em; }
  #weather { font-size: 3em; }
</style>
</head>
<body>
  <div id="time"></div>
  <div id="weather"></div>
  <script>
    async function fetchData() {
      var weatherApiUrl = {!! json_encode($weatherApiUrl) !!};
      var timeApiUrl = {!! json_encode($timeApiUrl) !!};

      try {
        const weatherResponse = await fetch(weatherApiUrl);
        const weatherData = await weatherResponse.json();
        const timeResponse = await fetch(timeApiUrl);
        const timeData = await timeResponse.json();

        document.getElementById('time').textContent = timeData.formatted;
        document.getElementById('weather').textContent = `${weatherData.main.temp}°C`;
      } catch (error) {
        console.error('Ошибка при получении данных:', error);
        document.getElementById('time').textContent = 'Ошибка загрузки' + error;
      }
    }

    fetchData();
    setInterval(fetchData, 30000);
  </script>
</body>
</html>