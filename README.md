# phpTableMaster
** THIS README IS NOT FINISHED.
PHP library to automate the dynamic creation of HTML tables. phpTableMaster makes it easier and quickier to create huge customizable HTML tables with numerous rows and columns. It is useful, for instance, for when you have a result set of a database query, and you need to show it as a table on screen - the library can create this table with three lines of code (or even less if you don't care for code readability).
Usage
Building a new table from a dataset

Let's say you have an entity in your database containing three columns: "userID", "name" and "age". Proceed with the usual modus operandi - fetch the results and push them into an array. That's enough of a dataset for our Reader.

Now all we have to do is define which of this columns will be included in the table and finally build it. Sounds simple, right? And it is!
```php
$params = [
    "userID" => [],
    "name" => [],
    "age" => []
];

$reader = new ArrayReader($dataSet, $params);
$table = $reader->getTable();

$builder = new TableBuilder($table);
$htmlTable = $builder->build();
```
All we did here was pass our dataset to ArrayReader, generate a Table object and then finally build it with TableBuilder. The $params variable will be pretty much the header of our table. Each index of `$params` must be a index of your dataset. In the example we wanted to show all three columns of the table, that's why we set them on `$params`, but should you choose, you could use only the "name" and "age" column - to do that, simply set the desired columns in `$params`. The array for each index of our parameters will be the settings for them, but more on that later.

The ArrayReader object will then generate a Table object based on the given dataset and parameters. This object can be read and transformed to a HTML table string by the TableBuilder. The resulting HTML string containing the table will be on `$htmlTable`. Just print it out wherever you want!
Customization

Of course the previous was just an extremely simple example. You have plenty of options to customize your table, like width, background color, applying PHP functions to cells, IDs, names, and so on. The complexity of your code will obviously depend on the amount of customization you apply to the table. A lot of this options can be set on the parameters you give to The Reader, for instance, if you want the "userID" column to have a width of "300px", simply go for:
```php
$params = [
    "userID" => [
        "width" => "300px"
    ],
    "name" => [],
    "age" => []
];
```
You also don't need to rely on the parameters to customize your table. If you are more old fashioned, you can set other options after you instantiate the Table object. Let's do the same thing as the last example, but now directly on our object:
```php
$table = $reader->getTable();
$table->getColumn(1)->setWidth("300px");
```
phpTableMaster has plenty more options and customizations. You can create from simple table views, to fully functional CRUDs with it. But that's enough for a README! You can find very detailed explanations and tutorials on the documentation.
