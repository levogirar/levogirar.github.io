// Scraping IMBD
// From https://www.youtube.com/watch?v=0NC9_R9TON4

function scrapeIMDB() {
	var movieDetails = [{}];

	movieDetails['Title'] = document.querySelector("#title-overview-widget > div.vital > div.title_block > div > div.titleBar > div.title_wrapper > h1").innerText;

	movieDetails['Release year'] = document.querySelector("#titleYear > a").innerText;

	movieDetails['Rating'] = document.querySelector("#title-overview-widget > div.vital > div.title_block > div > div.ratings_wrapper > div.imdbRating > div.ratingValue > strong > span").innerText;

	movieDetails;
};


var storeDetails = [{}];

storeDetails[0]['Company Name'] = document.querySelector("#post-77 > div > table:nth-child(1) > tbody > tr:nth-child(1) > td > h1").innerText;

storeDetails[0]['Description'] = document.querySelector("#post-77 > div > table:nth-child(1) > tbody > tr:nth-child(1) > td > p:nth-child(5)").innerText;

storeDetails[0]['Email'] =document.querySelector("#post-77 > div > table:nth-child(1) > tbody > tr:nth-child(1) > td > p:nth-child(12) > a").innerText;

storeDetails[0];

var title = document.getElementsByTagName("td")[0].innerHTML;
title;

var allRows = document.getElementsByTagName("td");
var entries = allRows.length;


for (let i = 0; i < entries; i++) {
	rowText = allRows[i].innerText;
}


