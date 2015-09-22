
var http = require("http");
var url = require("url");

function start(route,handle) {
    function onRequest(request, response) {
        var postData="";
        var pathname = url.parse(request.url).pathname;
        console.log("Request for " + pathname + " has received");
        request.setEncoding("utf8");
        request.addListener("data",function(postDataChunk){
            postData += postDataChunk;
            console.log("Received POST data chunk'"+postDataChunk+"'.");
        });
        request.addListener("end",function(chunk){
             route(pathname,handle,response,postData);
        });
    }

    http.createServer(onRequest).listen(8080);
    console.log("Server has start");
}
exports.start = start;

















