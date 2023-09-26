<div class="additional-content">
      <div class="additional-section">
      <div id="clock"></div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12; // Convert to 12-hour format

            const clockElement = document.getElementById('clock');
            clockElement.textContent = `${formattedHours}:${padZero(minutes)}:${padZero(seconds)} ${ampm}`;
        }

        function padZero(num) {
            return num < 10 ? `0${num}` : num;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial update
        updateClock();
    </script>


<!-- Quotes -->
<div id="quote-container">
        <!-- The random quote will be displayed here -->
    </div>

    <script>
        const quotes = [
            "It's not a bug, it's a feature. - Anonymous",
            "Code is like humor. When you have to explain it, it's bad. - Cory House",
            "Programming isn't about what you know; it's about what you can figure out. - Chris Pine",
            "First, solve the problem. Then, write the code. - John Johnson",
            "In software, the most beautiful code, the most beautiful functions, and the most beautiful programs are sometimes not there at all. - Jon Bentley",
            "The best error message is the one that never shows up. - Thomas Fuchs",
            "Measuring programming progress by lines of code is like measuring aircraft building progress by weight. - Bill"
        ];

        $(document).ready(function () {
            const randomIndex = Math.floor(Math.random() * quotes.length);
            const randomQuote = quotes[randomIndex];
            $("#quote-container").text(randomQuote);
        });
    </script>
        <div class="add-logo">
          <img src="../img/logo.png" alt="logo">
        </div>

      </div>
    </div>
  