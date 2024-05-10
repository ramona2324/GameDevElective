<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Game</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
        .btn {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .explode {
            animation: explode-animation 0.5s ease;
        }

        @keyframes explode-animation {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.5);
            }
            100% {
                transform: scale(1);
            }
        }

        .shake {
            animation: shake-animation 0.5s ease;
        }

        @keyframes shake-animation {
            0% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-10px);
            }
            50% {
                transform: translateX(10px);
            }
            75% {
                transform: translateX(-10px);
            }
            100% {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-200 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div id="message" class="text-center text-xl mb-4"></div>
        <div id="numbers" class="flex justify-center gap-8"></div>
    </div>

    {{-- Script --}}
    <script>
        const messageElement = document.getElementById('message');
        const numbersElement = document.getElementById('numbers');

        // Array to hold possible messages and correct numbers
        const messages = ["Click number One", "Click number Two", "Click number Three", "Click number Four", "Click number Five", "Click number Six", "Click number Seven", "Click number Eight", "Click number Nine", "Click number Ten"];
        const correctNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        // Function to generate random message and numbers
        function generateRandomMessage() {
            const randomIndex = Math.floor(Math.random() * messages.length);
            const message = messages[randomIndex];
            const correctNumber = correctNumbers[randomIndex];
            const numbers = [];

            // Generate two unique random numbers for wrong answers
            const wrongNumbers = [];
            while (wrongNumbers.length < 2) {
                const randomNumber = Math.floor(Math.random() * 10) + 1;
                if (!wrongNumbers.includes(randomNumber) && randomNumber !== correctNumber) {
                    wrongNumbers.push(randomNumber);
                }
            }

            // Combine correct and wrong numbers
            numbers.push(correctNumber);
            numbers.push(...wrongNumbers);

            // Shuffle numbers array
            numbers.sort(() => Math.random() - 0.5);

            // Display message and numbers
            messageElement.textContent = message;
            numbersElement.innerHTML = '';
            numbers.forEach(number => {
                const button = document.createElement('button');
                button.textContent = number;
                button.classList.add('btn');
                button.addEventListener('click', () => checkAnswer(parseInt(number), correctNumber));
                numbersElement.appendChild(button);
            });
        }

        // Function to check if the clicked number is correct
        function checkAnswer(clickedNumber, correctNumber) {
            if (clickedNumber === correctNumber) {
                explodeEffect(clickedNumber);
                setTimeout(generateRandomMessage, 1000); // Delay for effect
            } else {
                shakeEffect(clickedNumber);
            }
        }

        // Function to simulate explosion effect
        function explodeEffect(number) {
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                if (button.textContent === number.toString()) {
                    button.classList.add('explode');
                    setTimeout(() => button.classList.remove('explode'), 500);
                }
            });
        }

        // Function to simulate shaking effect
        function shakeEffect(number) {
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                if (button.textContent === number.toString()) {
                    button.classList.add('shake');
                    setTimeout(() => button.classList.remove('shake'), 500);
                }
            });
        }

        // Initialize game
        generateRandomMessage();
    </script>
</body>
</html>
