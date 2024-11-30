<?php

// prepare_execute.php

// This script demonstrates the **Prepared Statements** mechanism in PDO, 
// using the `prepare()` and `execute()` methods. This is the **safest and best 
// practice** method for running SQL queries, especially when dealing with user input, 
// as it prevents **SQL Injection** attacks.

echo "<h1>PDO Prepared Statements (prepare() & execute()) Demo 🛡️</h1>";

// ---------------------------------------------------------------------
// 1. Configuration and Connection
// ---------------------------------------------------------------------

$host = 'localhost';
$db = 'testdb';
$user = 'testuser';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = null;

try {
    $pdo = new \PDO($dsn, $user, $pass, $options);
    echo "<p style='color: green;'>✅ **SUCCESS:** Connected to the database '{$db}'.</p>";

    // Ensure the table exists for demonstration purposes
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS pdo_employees (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            salary DECIMAL(10, 2) NOT NULL,
            department VARCHAR(50)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    
    // Clear the table for a clean run
    $pdo->exec("TRUNCATE TABLE pdo_employees;");
    echo "<p>Table `pdo_employees` prepared for demo.</p>";

} catch (\PDOException $e) {
    echo "<p style='color: red;'>❌ **CONNECTION ERROR:** " . $e->getMessage() . "</p>";
    die(); 
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. INSERT: Using Named Placeholders (The Best Practice)
// ---------------------------------------------------------------------

echo "<h2>2. INSERT with Named Placeholders (Data Sanitization)</h2>";

$name = "Bob Smith";
$salary = 65000.00;
$dept = "Marketing";
// Imagine this data came from a user form!

// 2a. Prepare the SQL statement with named placeholders (:name, :salary, :dept)
$sql = "INSERT INTO pdo_employees (name, salary, department) VALUES (:name, :salary, :dept)";
$stmt = $pdo->prepare($sql);

// 2b. Define the data array to bind to the placeholders
$data = [
    ':name' => $name,
    ':salary' => $salary,
    ':dept' => $dept
];

// 2c. Execute the statement, sending the data separately
$stmt->execute($data);
$lastId = $pdo->lastInsertId();

echo "<p>✅ Inserted employee **{$name}** (ID: {$lastId}).</p>";

// ---------------------------------------------------------------------
// 3. INSERT: Using Question Mark Placeholders (?)
// ---------------------------------------------------------------------

echo "<h2>3. INSERT with Question Mark Placeholders</h2>";

$name2 = "Alice Jones";
$salary2 = 80000.00;
$dept2 = "Engineering";

// 3a. Prepare the SQL statement with positional placeholders (?)
$sql2 = "INSERT INTO pdo_employees (name, salary, department) VALUES (?, ?, ?)";
$stmt2 = $pdo->prepare($sql2);

// 3b. Execute, passing the values as an array in the **CORRECT ORDER**
$stmt2->execute([$name2, $salary2, $dept2]);
$lastId2 = $pdo->lastInsertId();

echo "<p>✅ Inserted employee **{$name2}** (ID: {$lastId2}).</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. SELECT: Retrieving Data with a WHERE Clause
// ---------------------------------------------------------------------

echo "<h2>4. SELECT with Bound Parameters (Filtering)</h2>";

// Parameter to filter the results (e.g., from a search box)
$targetDept = "Marketing";

// 4a. Prepare the SQL statement
$sql3 = "SELECT id, name, salary FROM pdo_employees WHERE department = :dept ORDER BY salary DESC";
$stmt3 = $pdo->prepare($sql3);

// 4b. Execute the statement with the binding value
$stmt3->execute([':dept' => $targetDept]);

echo "<h3>Employees in {$targetDept}:</h3>";
echo "<ul>";

// 4c. Fetch and display the results
$employees = $stmt3->fetchAll();

if (empty($employees)) {
    echo "<li>No employees found in this department.</li>";
} else {
    foreach ($employees as $employee) {
        echo "<li>ID: {$employee['id']} | Name: {$employee['name']} | Salary: \${$employee['salary']}</li>";
    }
}
echo "</ul>";

echo "<hr>";

// ---------------------------------------------------------------------
// 5. UPDATE: Modifying Records
// ---------------------------------------------------------------------

echo "<h2>5. UPDATE Statement</h2>";

$increaseAmount = 5000.00;
$employeeIdToUpdate = $lastId;

$sql4 = "UPDATE pdo_employees SET salary = salary + :increase WHERE id = :id";
$stmt4 = $pdo->prepare($sql4);

$stmt4->execute([
    ':increase' => $increaseAmount,
    ':id' => $employeeIdToUpdate
]);

$rowsAffected = $stmt4->rowCount();

echo "<p>✅ Updated employee ID **{$employeeIdToUpdate}**'s salary by \${$increaseAmount}. Rows affected: {$rowsAffected}</p>";

// ---------------------------------------------------------------------
// 6. Connection Closure
// ---------------------------------------------------------------------

$pdo = null;
echo "<p>Connection closed.</p>";
?>