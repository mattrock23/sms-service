function graph($, data) {
	var leftOfGraph = 35, 
	rightOfGraph = 660, 
	bottomOfGraph = 215,
	topOfGraph = 25,
	highest = data['highest'];
	data.splice('highest', 1);
	var hUnits = data.length,
	hSpacing = (rightOfGraph - leftOfGraph) / (hUnits - 1),
	vUnits = Math.floor(highest / 5) * 7,
	vSpacing = (bottomOfGraph - topOfGraph) / vUnits,
	canvas = $("#canvas");
	
	canvas.drawText({
		fillStyle: "#000",
		x: 350, y: 15,
		fromCenter: true,
		fontSize: "12pt",
		fontFamily: "Verdana, sans-serif",
		text: "Number of Subscribers during May 2013"
	});
	canvas.drawRect({
		strokeStyle: "#000",
		y: topOfGraph, x: leftOfGraph,
		width: rightOfGraph - leftOfGraph,
		height: bottomOfGraph - topOfGraph,
		fromCenter: false
	});

	for (var i = 0; i < hUnits; i++) {
		canvas.drawLine({
			strokeStyle: "#000",
			strokeWidth: 1,
			x1: leftOfGraph + i * hSpacing, y1: bottomOfGraph,
			x2: leftOfGraph + i * hSpacing, y2: bottomOfGraph + 5
		});
		canvas.drawText({
			fillStyle: "#000",
			x: leftOfGraph + i * hSpacing,
			y: bottomOfGraph + 12,
			fromCenter: true,
			fontSize: "8pt",
			fontFamily: "Verdana, sans-serif",
			text: i + 1
		})
	};
	for (var i = 2; i < vUnits; i += 2) {
		canvas.drawLine({
			strokeStyle: "#000",
			strokeWidth: 1,
			x1: leftOfGraph, y1: topOfGraph + i * vSpacing,
			x2: rightOfGraph, y2: topOfGraph + i * vSpacing
		});
		canvas.drawText({
			fillStyle: "#000",
			x: leftOfGraph - 15,
			y: topOfGraph + i * vSpacing,
			fromCenter: true,
			fontSize: "8pt",
			fontFamily: "Verdana, sans-serif",
			text: vUnits - i
		})
	};
	for (var i = 0; i <= hUnits; i++) {
		canvas.drawLine({
			strokeStyle: "#f00",
			strokeWidth: 3,
			x1: leftOfGraph + i * hSpacing, y1: bottomOfGraph - data[i] * vSpacing,
			x2: leftOfGraph + (i + 1) * hSpacing, y2: bottomOfGraph - data[i + 1] * vSpacing
		});
	};
	//set up graph, height based on data['highest'](then delete data['highest']), and number of plot points based on data.length
	//draw lines between the plot points (use a for loop that loops data.length-1 times drawing a line from data[i] to data[i+1])
};