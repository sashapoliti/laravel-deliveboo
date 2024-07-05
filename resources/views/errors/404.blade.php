@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code')

<style>
body{
    font-family: 'Courier New', Courier, monospace;
    text-align: center;
}

#board{
    display: none;
    background-color: lightgray;
    border-bottom: 1px solid black;
}
#restart{
    display: none;
}
.d-none {
    display: none;
}
</style>

<div class="container" >
    <div class="container  mt-5" id="first_dino">
        <img src="/img/dino_game/dino.png" alt="dino">
        <h3 class="align-content-end">404 NOT FOUND</h3>
    </div>
    <div class="d-flex justify-content-center mt-5 position-relative">
        <canvas id="board" width="750" height="250"></canvas>
        <div class="position-absolute top-50 start-50 translate-middle"  id="restart">
            <h5>You Score is:<span id="final_score"></span></h5>
            <button>RESTART</button>
        </div>
    </div>
</div>


    <script>
        let game = {
            // Proprietà del gioco
            board: null,
            context: null,
            dino: null,
            cactusArray: [],
            velocityX: -4,
            velocityY: 0,
            gravity: 0.3,
            gameOver: false,
            score: 0,
            images: {},
            scoreCounter: 0,

            // Inizializza il gioco
            init: function() {
                // Ottiene l'elemento canvas e il suo contesto
                this.board = document.getElementById("board");
                this.context = this.board.getContext("2d");

                // Imposta le proprietà del dinosauro
                this.dino = {
                    x: 50,
                    y: this.board.height - 94,
                    width: 88,
                    height: 94,
                    velocityY: 0,
                    gravity: 0.3
                };

                // Carica le immagini
                this.loadImages();
                // esso ascola il pulsante di avvio del gioco
                document.addEventListener("keydown", this.moveDino.bind(this));
                // Avvia il gioco
                this.startGame();
            },

            // Carica tutte le immagini necessarie per il gioco
            loadImages: function() {
                this.images.dino = new Image();
                this.images.dino.src = "/img/dino_game/dino.png";

                this.images.dinorun1 = new Image();
                this.images.dinorun1.src = "/img/dino_game/dino-run1.png";

                this.images.dinorun2 = new Image();
                this.images.dinorun2.src = "/img/dino_game/dino-run2.png";

                this.images.dinoDead = new Image();
                this.images.dinoDead.src = "/img/dino_game/dino-dead.png";

                this.images.cactus1 = new Image();
                this.images.cactus1.src = "/img/dino_game/cactus1.png";

                this.images.cactus2 = new Image();
                this.images.cactus2.src = "/img/dino_game/cactus2.png";

                this.images.cactus3 = new Image();
                this.images.cactus3.src = "/img/dino_game/cactus3.png";
            },

            // Avvia il gioco e imposta i listener per i pulsanti
            startGame: function() {
                // Resetta lo stato del gioco
                this.resetGame();
                // Listener per il pulsante di avvio del gioco
                document.getElementById("first_dino").addEventListener("click", () => {
                    document.getElementById("board").style.display = "block";
                    document.getElementById("first_dino").style.display = "none";
                    // Inizia l'animazione del gioco
                    requestAnimationFrame(this.update.bind(this));
                    // Imposta un intervallo per generare i cactus
                    setInterval(this.placeCactus.bind(this), 1000);
                });

                // Listener per il pulsante di riavvio del gioco
                document.getElementById("restart").addEventListener("click", () => {
                    this.resetGame();
                    document.getElementById("restart").style.display = "none";
                    // Riprende l'animazione del gioco
                    requestAnimationFrame(this.update.bind(this));
                });
            },

            // Resetta lo stato del gioco
            resetGame: function() {
                this.cactusArray = [];
                this.velocityX = -4;
                this.velocityY = 0;
                this.dino.y = this.board.height - this.dino.height;
                this.dino.velocityY = 0;
                this.gameOver = false;
                this.score = 0;
                this.scoreCounter = 0;
                this.images.dino.src = "/img/dino_game/dino.png";
            },

            // Aggiorna lo stato del gioco
            update: function() {
                if (this.gameOver) return;

                this.context.clearRect(0, 0, this.board.width, this.board.height);

                // Cambia l'immagine del dinosauro ogni 10 frame
                if (this.score % 12 === 0) {
                    this.dino.img = (this.dino.img === this.images.dinorun1) ? this.images.dinorun2 : this.images
                        .dinorun1;
                }

                this.dino.velocityY += this.dino.gravity;
                this.dino.y = Math.min(this.dino.y + this.dino.velocityY, this.board.height - this.dino.height);
                this.context.drawImage(this.dino.img, this.dino.x, this.dino.y, this.dino.width, this.dino.height);

                for (let i = 0; i < this.cactusArray.length; i++) {
                    let cactus = this.cactusArray[i];
                    cactus.x += this.velocityX;
                    this.context.drawImage(cactus.img, cactus.x, cactus.y, cactus.width, cactus.height);

                    if (this.detectCollision(this.dino, cactus)) {
                        this.gameOver = true;
                        document.getElementById("restart").style.display = "block";
                        this.images.dino.src = this.images.dinoDead.src;
                        this.context.drawImage(this.images.dinoDead, this.dino.x, this.dino.y, this.dino.width, this
                            .dino.height);
                        return;
                    }
                }

                this.context.fillStyle = "black";
                this.context.font = "20px courier";

                // Incrementa il contatore dello score
                this.scoreCounter++;
                if (this.scoreCounter % 5 === 0) {
                    this.score++;
                    document.getElementById("final_score").textContent = " " + this.score;
                }
                this.context.fillText(this.score, 5, 20);

                requestAnimationFrame(this.update.bind(this));
            },

            // Gestisce il movimento del dinosauro
            moveDino: function(e) {
                if (this.gameOver) return;

                if ((e.code === "Space" || e.code === "ArrowUp") && this.dino.y === this.board.height - this
                    .dino.height) {
                    this.dino.velocityY = -10;
                    this.dino.img = this.images.dino;
                }
            },

            // Genera e posiziona un nuovo cactus
            placeCactus: function() {
                if (this.gameOver) return;

                let cactus = {
                    img: null,
                    x: 700,
                    y: this.board.height - 70,
                    width: null,
                    height: 70
                };

                // Seleziona un cactus casuale
                let chance = Math.random();
                if (chance > 0.9) {
                    cactus.img = this.images.cactus3;
                    cactus.width = 102;
                } else if (chance > 0.7) {
                    cactus.img = this.images.cactus2;
                    cactus.width = 69;
                } else {
                    cactus.img = this.images.cactus1;
                    cactus.width = 34;
                }

                // Aggiunge il cactus all'array dei cactus
                this.cactusArray.push(cactus);
                // Limita il numero di cactus nell'array
                if (this.cactusArray.length > 5) {
                    this.cactusArray.shift();
                }
            },

            // Controlla le collisioni tra due oggetti
            detectCollision: function(a, b) {
                return a.x < b.x + b.width &&
                    a.x + a.width > b.x &&
                    a.y < b.y + b.height &&
                    a.y + a.height > b.y;
            }
        };

        // Inizializza il gioco quando la finestra è caricata
        window.onload = function() {
            game.init();
        }; 
    </script>
@endsection
