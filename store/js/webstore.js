window.alert("Sorry! Webstore is not ready yet, fell free to register and come back soon.");

window.onload = setupPage;

function setupPage()
{
    var guessStart = document.getElementById("guessStart");
    guessStart.addEventListener("click", playGuessGame);
}

function playGuessGame()
{
    var numberToGuess = Math.floor(Math.random() * 101);
    var correct = false;
    var guess = null;
    while(!correct)
    {
        guess = window.prompt("Guess number in range 0..100");
        guess = parseInt(guess);
        if(Number.isFinite(guess))
        {
            if (guess < numberToGuess)
                window.alert("The number you have entered is too small");
            else if(guess > numberToGuess)
                window.alert("The number you have entered is too big");
            else
            {
                window.alert("That's correct!");
                correct = true;
            }
        }
        else
            window.alert("Please enter valid integer");
    }
}
