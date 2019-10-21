var express = require('express');
var app = express();

require('dotenv').config()

app.set('port', (process.env.PORT || 5000));
app.engine('html', require('ejs').renderFile);
app.set('view engine', 'ejs');
app.set('views', __dirname + '/public');

app.get('/', function(request, response) {
  var env = process.env.APP_ENV;
  if (env == 'staging') {
    var envName = 'staging'
  } else if (env == 'production') {
    var envName = 'production'
  } else {
    var envName = 'review app'
  }
  response.render('index.html', { env: envName});
});

app.listen(app.get('port'), function() {
  console.log("Node app running at localhost:" + app.get('port'));
});

module.exports = app




const { Client } = require('pg');

const client = new Client({
  connectionString: process.env.DATABASE_URL,
  ssl: true,
});

client.connect();

client.query('SELECT table_schema,table_name FROM information_schema.tables;', (err, res) => {
  if (err) throw err;
  for (let row of res.rows) {
    console.log(JSON.stringify(row));
  }
  client.end();
});
