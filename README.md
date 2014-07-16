internetyesterday
=================

www.internetyesterday.com


COLLECTING DATA FROM SOURCES

There is a PHP script for each source we use, titled <sourcename>.php.

These scripts grab the most recent top post from the source and add it to the JSON file where the data is stored.  They do this
without getting rid of other content (by using PHP's associative arrays), so you can run any script without worrying about messing
up all of the other sources' data.

To run all of these scripts at once, just run the data.php script.


index.html stores the HTML.  There is a script that inserts the content from newData.json into the page.

style.css is the stylesheet.



Creators:
John Palmer
Wilson Cusack
Frank Goodman

