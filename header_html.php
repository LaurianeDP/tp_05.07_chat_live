<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat en ligne</title>
    <link rel="stylesheet" href="./bootstrap.css">
    <style>
        .hauteur {
            height: 89vh;
        }
        .accordion-button::after {
            background-image: none;
        }
        .accordion-button:not(.collapsed)::after {
            background-image: none;
        }
        #bouton {
            height: 6vh;
            width: 6vh;
        }
        .min-width {
            min-width: 50px;
            min-height: 50px;
        }
        .amis {
            min-height: 55vh;
            max-width: 70vh;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        #date {
            font-size: 0.8rem;
        }
        .left-menu {
            min-height: 80vh;
        }
        .messages {
            max-height: 75vh;
        }
        .header {
            background-color: lightgray;
        }
        .bubble {
            max-width: 50%!important;
        }
        .ami-btn {
            overflow: hidden!important;
        }
        .lastMess {
            text-overflow: ellipsis!important;
            white-space: nowrap;
            overflow: hidden!important;
        }

    </style>
    <script src="https://kit.fontawesome.com/34451dc3f2.js" crossorigin="anonymous"></script>
    <script src="./bootstrap.js"></script>
</head>