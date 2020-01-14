const myColor = ['#39ca74', '#e54d42', '#d68910', '#3999d8', '#808080', '#800080'];
const myLabel = ['Protéines', 'Lipides', 'Cendres', 'Fibres', 'Humidités', 'Glucides'];

const bringElement = document.getElementById('graph-bring');

let bring = bringElement.dataset.graph.split(',');
bring = bring.map((coord) => {
    return +coord;
});

function getTotal() {
    let myTotal = 0;
    for (let j = 0; j < bring.length; j++) {
        myTotal += (typeof bring[j] === 'number') ? bring[j] : 0;
    }
    return myTotal;
}

// Find that magical point
function getPoint(c1, c2, radius, angle) {
    return [c1 + Math.cos(angle) * radius, c2 + Math.sin(angle) * radius];
}


function plotData() {
    let lastend = 0;
    const myTotal = getTotal();
    const canvas = document.getElementById('canvas');
    const x = (canvas.width) / 2;
    const y = (canvas.height) / 2;
    const r = 150;

    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let i = 0; i < bring.length; i++) {
        ctx.fillStyle = myColor[i];
        ctx.beginPath();
        ctx.moveTo(x, y);
        ctx.arc(x, y, r, lastend, lastend + (Math.PI * 2 * (bring[i] / myTotal)), false);
        ctx.lineTo(x, y);
        ctx.fill();

        // Now the pointers
        ctx.beginPath();
        let start = [];
        let end = [];
        let flip = 0;
        let textOffset = 0;
        const percentage = (bring[i] / myTotal) * 100;
        start = getPoint(x, y, r - 20, (lastend + (Math.PI * 2 * (bring[i] / myTotal)) / 2));
        end = getPoint(x, y, r + 20, (lastend + (Math.PI * 2 * (bring[i] / myTotal)) / 2));
        if (start[0] <= x) {
            flip = -1;
            textOffset = -110;
        } else {
            flip = 1;
            textOffset = 10;
        }
        ctx.moveTo(start[0], start[1]);
        ctx.lineTo(end[0], end[1]);
        ctx.lineTo(end[0] + 120 * flip, end[1]);
        ctx.strokeStyle = '#bdc3c7';
        ctx.lineWidth = 2;
        ctx.stroke();
        // The labels
        ctx.font = '17px Arial';
        ctx.fillText(`${myLabel[i]} ${percentage.toFixed(2)}%`, end[0] + textOffset, end[1] - 4);
        // Increment Loop
        lastend += Math.PI * 2 * (bring[i] / myTotal);
    }
}

// The drawing
plotData();
