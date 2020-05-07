<?php

declare(strict_types=1);

namespace App\DBA;

/**
 * Class DBA
 * @package App\DBA
 */
class DBA
{
    const FETCH_ALL = 'fetchAll';
    const FETCH = 'fetch';

    /** @var \PDO */
    protected \PDO $pdo;

    /** @var DBA|null */
    private static ?DBA $instance = null;

    /**
     * @return DBA
     */
    public static function create(): DBA
    {
        if (static::$instance === null) {
            $db = self::getParams();
            $pdo = new \PDO($db['dsn'], $db['login'], $db['password']);
            $pdo->exec('SET TRANSACTION ISOLATION LEVEL REPEATABLE READ');
            static::$instance = new static($pdo);
        }

        return static::$instance;
    }

    /**
     * @return array
     */
    protected static function getParams(): array
    {
        $db = $_ENV['database'];
        return [
            'dsn' => "{$db['type']}:host={$db['host']};port={$db['port']};dbname={$db['name']}",
            'login' => $db['login'],
            'password' => $db['password']
        ];
    }

    private function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $params
     * @return false|int
     */
    public function exec(string $params)
    {
        return $this->pdo->exec($params);
    }

    /**
     * @param string $sql
     * @param array $params
     * @param string $fetch
     * @param int|string $fetchAs
     * @return mixed
     */
    public function select(string $sql, array $params = [], string $fetch = self::FETCH, int $fetchAs = \PDO::FETCH_OBJ)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->$fetch($fetchAs);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function update(string $sql, array $params = []): bool
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * @param \Closure $callback
     * @return bool
     */
    public function transaction(\Closure $callback): bool
    {
        try {
            $this->pdo->beginTransaction();
            $callback();
            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            // @todo handle
            var_dump($e->getMessage());
            return false;
        }
    }
}
