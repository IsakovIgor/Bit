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

    public static function create()
    {
        if (static::$instance === null) {
            $db = self::getParams();
            $pdo = new \PDO($db['dsn'], $db['login'], $db['password']);
            static::$instance = new static($pdo);
        }

        return static::$instance;
    }

    protected static function getParams()
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
     * @param string $fetchType
     * @param int|string $fetchAs
     * @return mixed
     */
    public function select(
        string $sql,
        array $params = [],
        string $fetchType = self::FETCH,
        int $fetchAs = \PDO::FETCH_OBJ
    )
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->$fetchType($fetchAs);
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
