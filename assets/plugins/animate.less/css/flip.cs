@-webkit-keyframes flip {
  0% {
    -webkit-transform: perspective(400px) rotateY(0);
    -webkit-animation-timing-function: ease-out;
  }
  40% {
    -webkit-transform: perspective(400px) translateZ(150px) rotateY(170deg);
    -webkit-animation-timing-function: ease-out;
  }
  50% {
    -webkit-transform: perspective(400px) translateZ(150px) rotateY(190deg) scale(1);
    -webkit-animation-timing-function: ease-in;
  }
  80% {
    -webkit-transform: perspective(400px) rotateY(360deg) scale(0.95);
    -webkit-animation-timing-function: ease-in;
  }
  100% {
    -webkit-transform: perspective(400px) scale(1);
    -webkit-animation-timing-function: ease-in;
  }
}
@-moz-keyframes flip {
  0% {
    -moz-transform: perspective(400px) rotateY(0);
    -moz-animation-timing-function: ease-out;
  }
  40% {
    -moz-transform: perspective(400px) translateZ(150px) rotateY(170deg);
    -moz-animation-timing-function: ease-out;
  }
  50% {
    -moz-transform: perspective(400px) translateZ(150px) rotateY(190deg) scale(1);
    -moz-animation-timing-function: ease-in;
  }
  80% {
    -moz-transform: perspective(400px) rotateY(360deg) scale(0.95);
    -moz-animation-timing-function: ease-in;
  }
  100% {
    -moz-transform: perspective(400px) scale(1);
    -moz-animation-timing-function: ease-in;
  }
}
@-o-keyframes flip {
  0% {
    -o-transform: perspective(400px) rotateY(0);
    -o-animation-timing-function: ease-out;
  }
  40% {
    -o-transform: perspective(400px) translateZ(150px) rotateY(170deg);
    -o-animation-timing-function: ease-out;
  }
  50% {
    -o-transform: perspective(400px) translateZ(150px) rotateY(190deg) scale(1);
    -o-animation-timing-function: ease-in;
  }
  80% {
    -o-transform: perspective(400px) rotateY(360deg) scale(0.95);
    -o-animation-timing-function: ease-in;
  }
  100% {
    -o-transform: perspective(400px) scale(1);
    -o-animation-timing-function: ease-in;
  }
}
@keyframes flip {
  0% {
    transform: perspective(400px) rotateY(0);
    animation-timing-function: ease-out;
  }
  40% {
    transform: perspective(400px) translateZ(150px) rotateY(170deg);
    animation-timing-function: ease-out;
  }
  50% {
    transform: perspective(400px) translateZ(150px) rotateY(190deg) scale(1);
    animation-timing-function: ease-in;
  }
  80% {
    transform: perspective(400px) rotateY(360deg) scale(0.95);
    animation-timing-function: ease-in;
  }
  100% {
    transform: perspective(400px) scale(1);
    animation-timing-function: ease-in;
  }
}
.flip {
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-backface-visibility: visible !important;
  -webkit-animation-name: flip;
  -moz-backface-visibility: visible !important;
  -moz-animation-name: flip;
  -o-backface-visibility: visible !important;
  -o-animation-name: flip;
  backface-visibility: visible !important;
  animation-name: flip;
}
