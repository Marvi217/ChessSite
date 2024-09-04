<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szachy</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/chess1.css">
</head>
<body>
    <?php require("menu.php"); ?>
    <div class="chess_panel">
        <div class="game_panel">
            <div class="chess_game">
                <div id="chess-board"></div>
            </div>
            <div id="status">White's turn</div>
        </div>
    </div>
    <?php require("footer.php"); ?>
    <script>

        class Piece {
            constructor(color) {
                this.color = color;
                this.row = -1;
                this.col = -1;
                this.gameOver = false;
            }

            getColor() {
                return this.color;
            }

            setPosition(row, col) {
                this.row = row;
                this.col = col;
            }

            getPosition() {
                return [this.row, this.col];
            }

            getValidMoves(board) {
                return validMoves;
            }

            getImagePath() {
                return `obrazki/pieces/${this.color}_${this.constructor.name.toLowerCase()}.png`;
            }
        }

        class Pawn extends Piece {
            getValidMoves(board) {
                const validMoves = [];
                const direction = this.color === "white" ? -1 : 1;
                const [row, col] = this.getPosition();
                
                if (board.isEmpty(row + direction, col)) {
                    validMoves.push([row + direction, col]);

                    if ((this.color === "white" && row === 6) || (this.color === "black" && row === 1)) {
                        if (board.isEmpty(row + 2 * direction, col)) {
                            validMoves.push([row + 2 * direction, col]);
                        }
                    }
                }

                if (board.isOpponentPiece(row + direction, col - 1, this.color)) {
                    validMoves.push([row + direction, col - 1]);
                }

                if (board.isOpponentPiece(row + direction, col + 1, this.color)) {
                    validMoves.push([row + direction, col + 1]);
                }

                return validMoves;
            }
        }

        class Rook extends Piece {
            getValidMoves(board) {
                const validMoves = [];
                const directions = [
                    [1, 0], [-1, 0], [0, 1], [0, -1]
                ];
                for (const [dx, dy] of directions) {
                    let [row, col] = this.getPosition();
                    while (true) {
                        row += dx;
                        col += dy;
                        if (!board.isValidPosition(row, col)) break;
                        if (board.isEmpty(row, col)) {
                            validMoves.push([row, col]);
                        } else {
                            if (board.isOpponentPiece(row, col, this.color)) {
                                validMoves.push([row, col]);
                            }
                            break;
                        }
                    }
                }
                return validMoves;
            }
        }

        class Bishop extends Piece {
            getValidMoves(board) {
                const validMoves = [];
                const directions = [
                    [1, 1], [1, -1], [-1, 1], [-1, -1]
                ];
                for (const [dx, dy] of directions) {
                    let [row, col] = this.getPosition();
                    while (true) {
                        row += dx;
                        col += dy;
                        if (!board.isValidPosition(row, col)) break;
                        if (board.isEmpty(row, col)) {
                            validMoves.push([row, col]);
                        } else {
                            if (board.isOpponentPiece(row, col, this.color)) {
                                validMoves.push([row, col]);
                            }
                            break;
                        }
                    }
                }
                return validMoves;
            }
        }

        class Knight extends Piece {
            getValidMoves(board) {
                const validMoves = [];
                const moves = [
                    [2, 1], [2, -1], [-2, 1], [-2, -1],
                    [1, 2], [1, -2], [-1, 2], [-1, -2]
                ];
                const [row, col] = this.getPosition();
                for (const [dx, dy] of moves) {
                    const newRow = row + dx;
                    const newCol = col + dy;
                    if (board.isValidPosition(newRow, newCol) && 
                        (board.isEmpty(newRow, newCol) || board.isOpponentPiece(newRow, newCol, this.color))) {
                        validMoves.push([newRow, newCol]);
                    }
                }
                return validMoves;
            }
        }

        class Queen extends Piece {
            getValidMoves(board) {
                const validMoves = [];
                const directions = [
                    [1, 0], [-1, 0], [0, 1], [0, -1],
                    [1, 1], [1, -1], [-1, 1], [-1, -1]
                ];
                for (const [dx, dy] of directions) {
                    let [row, col] = this.getPosition();
                    while (true) {
                        row += dx;
                        col += dy;
                        if (!board.isValidPosition(row, col)) break;
                        if (board.isEmpty(row, col)) {
                            validMoves.push([row, col]);
                        } else {
                            if (board.isOpponentPiece(row, col, this.color)) {
                                validMoves.push([row, col]);
                            }
                            break;
                        }
                    }
                }
                return validMoves;
            }
        }

        class King extends Piece {
            getValidMoves(board) {
                const validMoves = [];
                const moves = [
                    [1, 0], [-1, 0], [0, 1], [0, -1],
                    [1, 1], [1, -1], [-1, 1], [-1, -1]
                ];
                const [row, col] = this.getPosition();
                for (const [dx, dy] of moves) {
                    const newRow = row + dx;
                    const newCol = col + dy;
                    if (board.isValidPosition(newRow, newCol) && 
                        (board.isEmpty(newRow, newCol) || board.isOpponentPiece(newRow, newCol, this.color))) {
                        validMoves.push([newRow, newCol]);
                    }
                }
                return validMoves;
            }
        }

        class Board {
            constructor() {
                this.board = this.initializeBoard();
                this.selectedPiece = null;
                this.currentTurn = "white";
                this.checkStatus = false;
                this.checkmateStatus = false;
                this.moveCount = 0;

            }

            initializeBoard() {
                const board = Array(8).fill(null).map(() => Array(8).fill(null));
                this.placePieces(board, "white");
                this.placePieces(board, "black");
                return board;
            }

            placePieces(board, color) {
                const row = color === "white" ? 7 : 0;
                board[row][0] = new Rook(color);
                board[row][7] = new Rook(color);
                board[row][1] = new Knight(color);
                board[row][6] = new Knight(color);
                board[row][2] = new Bishop(color);
                board[row][5] = new Bishop(color);
                board[row][3] = new Queen(color);
                board[row][4] = new King(color);

                const pawnRow = color === "white" ? 6 : 1;
                for (let i = 0; i < 8; i++) {
                    board[pawnRow][i] = new Pawn(color);
                    board[pawnRow][i].setPosition(pawnRow, i);
                }

                board[row][0].setPosition(row, 0);
                board[row][7].setPosition(row, 7);
                board[row][1].setPosition(row, 1);
                board[row][6].setPosition(row, 6);
                board[row][2].setPosition(row, 2);
                board[row][5].setPosition(row, 5);
                board[row][3].setPosition(row, 3);
                board[row][4].setPosition(row, 4);
            }

            isValidPosition(row, col) {
                return row >= 0 && row < 8 && col >= 0 && col < 8;
            }

            isEmpty(row, col) {
                return this.board[row][col] === null;
            }

            isOpponentPiece(row, col, color) {
                return this.board[row][col] && this.board[row][col].getColor() !== color;
            }

            movePiece(startRow, startCol, endRow, endCol) {
                if (this.isValidPosition(endRow, endCol)) {
                    const piece = this.board[startRow][startCol];

                    if (piece && piece.getValidMoves(this).some(move => move[0] === endRow && move[1] === endCol)) {
                        this.board[endRow][endCol] = piece;
                        piece.setPosition(endRow, endCol);
                        this.board[startRow][startCol] = null;

                        this.moveCount++;

                        if (this.checkForPromotion(endRow, endCol)) {
                            this.waitForPromotion();
                            this.switchTurn();
                        }else{
                            this.switchTurn();
                            this.render();
                        }

                    }
                }
            }

            isCheck(color) {
                const opponentColor = color === "white" ? "black" : "white";
                const [kingRow, kingCol] = this.findKingPosition(color);
                for (let row = 0; row < 8; row++) {
                    for (let col = 0; col < 8; col++) {
                        const piece = this.board[row][col];
                        if (piece && piece.getColor() === opponentColor) {
                            const moves = piece.getValidMoves(this);
                            if (moves.some(move => move[0] === kingRow && move[1] === kingCol)) {
                                if (!this.checkStatus) {
                                    this.checkStatus = true;
                                }
                                return true;
                            }
                        }
                    }
                }

                this.checkStatus = false;
                return false;
            }

            isCheckmate(color) {
                if (!this.isCheck(color)) {
                    this.checkmateStatus = false;
                    return false;
                }
                
                const savingMoves = [];

                for (let row = 0; row < 8; row++) {
                    for (let col = 0; col < 8; col++) {
                        const piece = this.board[row][col];
                        if (piece && piece.getColor() === color) {
                            const moves = piece.getValidMoves(this);
                            for (const [newRow, newCol] of moves) {
                                const simulatedBoard = this.simulateMove(row, col, newRow, newCol);
                                if (!simulatedBoard.isCheck(color)) {
                                    savingMoves.push([row, col, newRow, newCol]);
                                }
                            }
                        }
                    }
                }

                if (savingMoves.length === 0) {
                    this.checkmateStatus = true;
                    this.declareWinner(color === "white" ? "black" : "white");
                    return true;
                } else {
                    this.highlightSavingMoves(savingMoves);
                    return false;
                }
            }

            highlightSavingMoves(moves) {
                const boardDiv = document.getElementById("chess-board");
                const cells = boardDiv.getElementsByClassName("cell");
                for (const cell of cells) {
                    cell.style.border = "";
                    cell.classList.add('inactive');
                }

                moves.forEach(([startRow, startCol, endRow, endCol]) => {
                    const startCell = boardDiv.querySelector(`[data-row='${startRow}'][data-col='${startCol}']`);
                    const endCell = boardDiv.querySelector(`[data-row='${endRow}'][data-col='${endCol}']`);

                    if (startCell) {
                        startCell.style.border = "2px solid violet";
                        startCell.classList.remove('inactive');
                    }
                    if (endCell) {
                        endCell.style.border = "2px solid green";
                        endCell.classList.remove('inactive');
                        endCell.addEventListener("click", () => this.movePiece(startRow, startCol, endRow, endCol));
                    }
                });
            }

            findKingPosition(color) {
                for (let row = 0; row < 8; row++) {
                    for (let col = 0; col < 8; col++) {
                        const piece = this.board[row][col];
                        if (piece && piece.getColor() === color && piece instanceof King) {
                            return [row, col];
                        }
                    }
                }
                return [-1, -1];
            }

            getRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            declareWinner(winnerColor) {
                if (this.gameOver) return;
                const boardDiv = $("#chess-board");
                boardDiv.addClass("inactive");
                this.gameOver = true;
                const randomPoints = this.getRandomNumber(100, 1000);
                console.log(randomPoints);
                
                $.post("updatePoints.php", {
                    winnerColor: winnerColor,
                    points: randomPoints
                }, function(data) {
                    console.log(data);
                });
            }

            findSavingMoves(color) {
                const savingMoves = [];
                const opponentColor = color === "white" ? "black" : "white";
                const [kingRow, kingCol] = this.findKingPosition(color);

                for (let row = 0; row < 8; row++) {
                    for (let col = 0; col < 8; col++) {
                        const piece = this.board[row][col];
                        if (piece && piece.getColor() === color) {
                            const moves = piece.getValidMoves(this);
                            for (const [newRow, newCol] of moves) {
                                const simulatedBoard = this.simulateMove(row, col, newRow, newCol);
                                if (!simulatedBoard.isCheck(color)) {
                                    savingMoves.push([row, col]);
                                }
                            }
                        }
                    }
                }

                return savingMoves;
            }

            simulateMove(startRow, startCol, endRow, endCol) {
                const simulatedBoard = new Board();
                simulatedBoard.board = this.board.map(row => 
                    row.map(piece => piece ? Object.assign(Object.create(Object.getPrototypeOf(piece)), piece) : null)
                );

                const piece = simulatedBoard.board[startRow][startCol];
                simulatedBoard.board[endRow][endCol] = piece;
                piece.setPosition(endRow, endCol);
                simulatedBoard.board[startRow][startCol] = null;

                return simulatedBoard;
            }

            render() {
                const boardDiv = document.getElementById("chess-board");
                const statusDiv = document.getElementById("status");
                if (this.currentTurn === "white") {
                    statusDiv.textContent = "White's turn";
                } else {
                    statusDiv.textContent = "Black's turn";
                }
                boardDiv.innerHTML = "";

                for (let row = 0; row < 8; row++) {
                    for (let col = 0; col < 8; col++) {
                        const cellDiv = document.createElement("div");
                        cellDiv.className = "cell";
                        if ((row + col) % 2 === 0) cellDiv.classList.add('bright');
                        else cellDiv.classList.add('dark');;
                        
                        const piece = this.board[row][col];
                        if (piece) {
                            const pieceImg = document.createElement("img");
                            pieceImg.src = piece.getImagePath();
                            pieceImg.className = "piece";
                            cellDiv.appendChild(pieceImg);
                        }

                        cellDiv.dataset.row = row;
                        cellDiv.dataset.col = col;
                        cellDiv.addEventListener("click", () => this.handleCellClick(row, col));
                        boardDiv.appendChild(cellDiv);
                    }
                }

                statusDiv.classList.remove("whiteTurn", "blackTurn");
                if(this.currentTurn === "white"){
                    statusDiv.classList.add("whiteTurn");
                }else {
                    statusDiv.classList.add("blackTurn");
                }
                this.isCheckmate(this.currentTurn);
            }

            checkForPromotion(row, col) {
                const piece = this.board[row][col];
                if (piece instanceof Pawn) {
                    if ((piece.color === "white" && row === 0) || (piece.color === "black" && row === 7)) {
                        this.showPromotionMenu(row, col, piece.color);
                        return true;
                    }
                }
                return false;
            }

            showPromotionMenu(row, col, color) {
                const promotionMenu = document.createElement("div");
                promotionMenu.id = "promotion-menu";
                promotionMenu.style.display = "block";
                promotionMenu.style.position = "absolute";
                
                const tileSize = 60;
                const boardSize = 8 * tileSize;
                const centerX = boardSize / 2;
                const centerY = boardSize / 2;
                
                promotionMenu.style.left = `${centerX - (promotionMenu.offsetWidth / 2)}px`;
                promotionMenu.style.top = `${centerY - (promotionMenu.offsetHeight / 2)}px`;

                promotionMenu.dataset.row = row;
                promotionMenu.dataset.col = col;
                promotionMenu.dataset.color = color;

                const pieces = ["Queen", "Rook", "Bishop", "Knight"];
                pieces.forEach(piece => {
                    const button = document.createElement("button");
                    button.innerText = `Promote to ${piece}`;
                    button.onclick = () => this.promotePawn(piece);
                    promotionMenu.appendChild(button);
                });

                document.body.appendChild(promotionMenu);
            }

            hidePromotionMenu() {
                const promotionMenu = document.getElementById("promotion-menu");
                promotionMenu.style.display = "none";
            }

            waitForPromotion() {
                return new Promise((resolve) => {
                    let handler;

                    function handleClick(event) {
                        resolve(event.target.innerText);
                        document.removeEventListener('click', handler);
                    }

                    handler = handleClick;
                    document.addEventListener('click', handler);
                });
            }

            promotePawn(newPieceType) {
                const promotionMenu = document.getElementById("promotion-menu");
                const row = parseInt(promotionMenu.dataset.row, 10);
                const col = parseInt(promotionMenu.dataset.col, 10);
                const color = promotionMenu.dataset.color;
                
                let newPiece;
                switch (newPieceType) {
                    case 'Queen':
                        newPiece = new Queen(color);
                        break;
                    case 'Rook':
                        newPiece = new Rook(color);
                        break;
                    case 'Bishop':
                        newPiece = new Bishop(color);
                        break;
                    case 'Knight':
                        newPiece = new Knight(color);
                        break;
                }

                this.setPiece(row, col, newPiece);
                this.render();

                promotionMenu.style.display = "none";
            }

            setPiece(row, col, newPiece) {
                this.board[row][col] = newPiece;
                newPiece.setPosition(row, col);
            }

            handleCellClick(row, col) {
                if (this.selectedPiece === null) {
                    const piece = this.board[row][col];
                    if (piece && piece.getColor() === this.currentTurn && !this.checkmateStatus) {
                        this.selectedPiece = piece;
                        this.render();
                        this.highlightValidMoves(piece.getValidMoves(this));
                    }
                } else {
                    const [startRow, startCol] = this.selectedPiece.getPosition();
                    this.movePiece(startRow, startCol, row, col);
                    this.selectedPiece = null;
                    this.render();
                }
            }


            highlightValidMoves(moves) {
                const boardDiv = document.getElementById("chess-board");
                moves.forEach(([row, col]) => {
                    const cell = boardDiv.querySelector(`[data-row='${row}'][data-col='${col}']`);
                    if (cell) cell.style.backgroundColor = "lightgreen";
                });
            }

            switchTurn() {
                this.currentTurn = this.currentTurn === "white" ? "black" : "white";
            }
        }


        document.addEventListener("DOMContentLoaded", () => {
            board = new Board();
            board.render();
        });

    </script>

</body>
</html>
