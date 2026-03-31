<?php

declare(strict_types=1);

chdir(dirname(__DIR__));

require_once 'config.inc.php';

function openPerfMysqli(): mysqli {
    global $dbconfig;

    $host = isset($dbconfig['db_server']) ? (string) $dbconfig['db_server'] : 'localhost';
    $port = 3306;
    if (!empty($dbconfig['db_port'])) {
        $rawPort = str_replace(':', '', (string) $dbconfig['db_port']);
        if (is_numeric($rawPort)) {
            $port = (int) $rawPort;
        }
    }

    $user = isset($dbconfig['db_username']) ? (string) $dbconfig['db_username'] : 'root';
    $pass = isset($dbconfig['db_password']) ? (string) $dbconfig['db_password'] : '';
    $name = isset($dbconfig['db_name']) ? (string) $dbconfig['db_name'] : '';

    $mysqli = mysqli_init();
    if (!$mysqli) {
        throw new RuntimeException('Failed to initialize mysqli.');
    }

    $ok = $mysqli->real_connect($host, $user, $pass, $name, $port);
    if (!$ok) {
        throw new RuntimeException('MySQL connection failed: ' . mysqli_connect_error());
    }

    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}

function perfRoundsForDataset(int $datasetSize): int {
    if ($datasetSize <= 1000) {
        return 1;
    }
    if ($datasetSize <= 10000) {
        return 10;
    }
    return 100;
}

function runPerfSql(mysqli $db, string $sql, int $rounds): array {
    $start = microtime(true);
    $rowCount = 0;

    for ($i = 0; $i < $rounds; $i++) {
        $result = $db->query($sql);
        if ($result) {
            if ($result instanceof mysqli_result) {
                $rowCount += (int) $result->num_rows;
                $result->free();
            }
        } else {
            throw new RuntimeException('Query failed: ' . $db->error . ' SQL: ' . $sql);
        }
    }

    $elapsed = microtime(true) - $start;
    $memoryMb = memory_get_peak_usage(true) / 1024 / 1024;

    return array(
        'elapsed' => $elapsed,
        'memory_mb' => $memoryMb,
        'rows' => $rowCount,
    );
}

function runPerfScenario(
    mysqli $db,
    string $scenario,
    string $beforeSql,
    string $afterSql,
    array $datasetSizes
): void {
    echo "\nScenario: {$scenario}\n";
    echo "| Scenario | Before | After | Improvement % |\n";
    echo "|---|---:|---:|---:|\n";

    foreach ($datasetSizes as $datasetSize) {
        $rounds = perfRoundsForDataset((int) $datasetSize);

        $before = runPerfSql($db, $beforeSql, $rounds);
        $after = runPerfSql($db, $afterSql, $rounds);

        $improvement = 0.0;
        if ($before['elapsed'] > 0.0) {
            $improvement = (($before['elapsed'] - $after['elapsed']) / $before['elapsed']) * 100;
        }

        $beforeText = sprintf('%.6fs / %.2fMB', $before['elapsed'], $before['memory_mb']);
        $afterText = sprintf('%.6fs / %.2fMB', $after['elapsed'], $after['memory_mb']);
        $label = sprintf('%s (%dk)', $scenario, (int) ($datasetSize / 1000));

        echo '| ' . $label . ' | ' . $beforeText . ' | ' . $afterText . ' | ' . sprintf('%.2f%%', $improvement) . " |\n";
    }
}
