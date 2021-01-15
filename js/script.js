var today = new Date();

var date = today.getDate() + ' ' + today.toLocaleString('default', { month: 'long' }) + ' , ' + today.getFullYear();
var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();
var legend = "Last Updated: " + String(date);

var date_html = document.getElementById("current_date");
date_html.innerHTML = legend;