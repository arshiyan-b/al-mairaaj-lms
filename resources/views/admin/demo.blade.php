<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vimeo Video with Countdown</title>
    
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20px;
        }

        #timer {
            font-size: 2em;
            color: #ff0000;
            margin-top: 10px;
        }

        #warning {
            display: none;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            border-radius: 8px;
        }

        #warning button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #warning button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

    <h1>Vimeo Video with Countdown Timer</h1>

    <!-- Vimeo Video Embed -->
    <iframe id="vimeo-player"
            src="https://player.vimeo.com/video/1016625668?title=0&byline=0&portrait=0&badge=0"
            width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
    </iframe>
    
    <!-- Countdown Timer Display -->
    <div id="timer">Time watched: 0/15 seconds</div>
    
    <!-- Warning Modal -->
    <div id="warning">
        <h2>Time Limit Reached</h2>
        <p>You've reached the maximum allowed viewing time.</p>
        <button id="continue-btn">OK</button>
    </div>

</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the Vimeo player
    const iframe = document.querySelector('iframe');
    const player = new Vimeo.Player(iframe);
    const timerElement = document.getElementById('timer');
    const warningElement = document.getElementById('warning');
    const continueBtn = document.getElementById('continue-btn');
    
    let maxWatchTime = 5; // seconds
    let watchStartTime = null;
    let currentWatchTime = 0;
    let trackingSent = false;
    let beaconSent = false;
    let timerInterval = null;
    
    // Start timer when video starts playing
    player.on('play', function() {
        if (!watchStartTime) {
            watchStartTime = Date.now();
            startWatchTimer();
        }
    });
    
    // Track if user reaches the max watch time
    player.on('timeupdate', function(data) {
        currentWatchTime = data.seconds;
        updateTimerDisplay(currentWatchTime);
        
        if (currentWatchTime >= maxWatchTime && !trackingSent) {
            trackingSent = true;
            showWarning();
            sendTrackingData(maxWatchTime, true);
        }
    });
    
    // Handle when user pauses
    player.on('pause', function() {
        if (watchStartTime && !trackingSent) {
            const elapsedSeconds = Math.min(Math.floor((Date.now() - watchStartTime) / 1000), maxWatchTime);
            updateTimerDisplay(elapsedSeconds);
            sendTrackingData(elapsedSeconds, false);
        }
    });
    
    // Handle page unload (refresh or close)
    window.addEventListener('beforeunload', function() {
        if (watchStartTime && !trackingSent && !beaconSent) {
            const elapsedSeconds = Math.min(Math.floor((Date.now() - watchStartTime) / 1000), maxWatchTime);
            sendBeacon(elapsedSeconds, false);
        }
    });
    
    // Continue button click handler
    continueBtn.addEventListener('click', function() {
        // Redirect to next page
        window.location.href = '/video/track'; // Change this to your desired URL
    });
    
    function startWatchTimer() {
        // Clear any existing interval
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        
        // Update timer every second
        timerInterval = setInterval(function() {
            if (watchStartTime) {
                const elapsedSeconds = Math.min(Math.floor((Date.now() - watchStartTime) / 1000), maxWatchTime);
                updateTimerDisplay(elapsedSeconds);
                
                if (elapsedSeconds >= maxWatchTime && !trackingSent) {
                    trackingSent = true;
                    showWarning();
                    sendTrackingData(maxWatchTime, true);
                    clearInterval(timerInterval);
                }
            }
        }, 1000);
    }
    
    function updateTimerDisplay(seconds) {
        timerElement.textContent = `Time watched: ${seconds}/${maxWatchTime} seconds`;
    }
    
    function showWarning() {
        warningElement.style.display = 'block';
        player.pause(); // Pause the video when warning appears
    }
    
    function sendTrackingData(watchTime, completed) {
        const data = {
            video_id: '{{ $videoId }}', // Pass this from your controller
            user_id: '{{ auth()->id() }}',
            watch_time: watchTime,
            is_completed: completed,
            _token: '{{ csrf_token() }}'
        };
        
        fetch('{{ route("video.track") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
    }
    
    function sendBeacon(watchTime, completed) {
        beaconSent = true;
        const data = new FormData();
        data.append('video_id', '{{ $videoId }}');
        data.append('user_id', '{{ auth()->id() }}');
        data.append('watch_time', watchTime);
        data.append('is_completed', completed);
        data.append('_token', '{{ csrf_token() }}');
        
        // Use beacon API for more reliable unload tracking
        navigator.sendBeacon('{{ route("video.track") }}', data);
    }
});
</script>
</html>