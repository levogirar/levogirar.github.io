let walls = [];
let ray;
let particle;
let xoff = 0;
let yoff = 100;

let path = [];

let logo = beginShape();
			vertex(80.00000, 15.61590);
			vertex(77.16200, 9.55196);
			vertex(70.57560, 1.23424);
			vertex(66.02410, 0.00000);
			vertex(61.47260, 1.23424);
			vertex(58.47390, 4.77598);
			vertex(51.67340, 20.98210);
			vertex(50.22760, 22.27000);
			vertex(48.83530, 21.03580);
			vertex(47.22890, 17.38670);
			vertex(46.21150, 15.18660);
			vertex(41.49930, 4.77598);
			vertex(38.44710, 1.23424);
			vertex(33.94910, 0.00000);
			vertex(29.39760, 1.23424);
			vertex(26.29180, 4.77598);
			vertex(19.33070, 19.69420);
			vertex(17.88490, 20.98210);
			vertex(16.49260, 19.74790);
			vertex(16.49260, 19.69420);
			vertex(14.93980, 15.93780);
			vertex(12.20880, 12.39610);
			vertex(8.19277, 11.26920);
			vertex(2.51673, 13.36200);
			vertex(0.00000, 18.46000);
			vertex(0.64257, 21.41140);
			vertex(15.47520, 53.44810);
			vertex(18.63450, 56.98980);
			vertex(23.18610, 58.22410);
			vertex(27.73760, 56.98980);
			vertex(30.73630, 53.44810);
			vertex(37.48330, 37.51020);
			vertex(39.03610, 36.22230);
			vertex(40.48190, 37.34930);
			vertex(40.58900, 37.56390);
			vertex(42.08840, 40.83730);
			vertex(43.10580, 43.03750);
			vertex(47.76440, 53.39440);
			vertex(50.81660, 56.93610);
			vertex(55.31460, 58.17040);
			vertex(59.86610, 56.93610);
			vertex(62.97190, 53.39440);
			vertex(71.48590, 35.09540);
			vertex(77.85810, 21.67970);
			vertex(80.00000, 15.61590);
			endShape();


function setup() {
	createCanvas(400, 400);
	
	
	for (let i = 0; i <5; i++) {
		let x1 = random(width);
		let x2 = random(width);
		let y1 = random(height);
		let y2 = random(height);
		walls[i] = new Boundary(x1, y1, x2, y2);
	}

	walls.push(new Boundary(0, 0, width, 0));
	walls.push(new Boundary(width, 0, width, height));
	walls.push(new Boundary(0, width, height, height));
	walls.push(new Boundary(0, 0, 0, height));
	
	particle = new Particle();
}

function draw() {
	background(32);
	for (let wall of walls) {
		wall.show();
	}
	particle.update(noise(xoff) * width, noise(yoff) * height);
	particle.show();
	particle.look(walls);

	xoff += 0.01;
	yoff += 0.01;
	// ray.show();
	// ray.lookAt (mouseX, mouseY);

	// let pt = ray.cast(wall);
	// if (pt) {
	// 	fill(255);
	// 	ellipse(pt.x, pt.y, 8, 8);
	// }
}