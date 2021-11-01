<?php
class  EntityProvider
{
    public static function getEntities($con, $categoryId, $limit)
    {
        // Build thr SQL statement
        $sql = "SELECT * FROM entities ";

        // If a category is passed in then join the catergory with a WHERE clause
        if ($categoryId != null) {
            $sql .= "WHERE categoryId=:categoryId "; 
        }

        // Limit the query using a LIMIT clause
        $sql .= "ORDER BY RAND() LIMIT :limit";

        // Prepare the query
        $query = $con->prepare($sql);

        // If a category Id was provided then bind the placeholder with the Id
        if ($categoryId != null) {
            $query->bindValue(":categoryId", $categoryId);
        }

        // Bind the limit
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        
        // Execute the query
        $query->execute();

        // Create an empty array to store the data
        $result = array();

        // store the data in the array
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // push the row onto the array
            $result[] = new Entity($con, $row);
        }
        return $result;
    }
}
