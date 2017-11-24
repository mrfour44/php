<?php
    header('content-type:text/html;chartset=utf-8');
    class PdoMySQL
    {
        public static $config = array(); // 设置连接参数, 配置信息
        public static $link = null; // 保存连接标识符
        public static $pconnect = false; // 是否支持长连接
        public static $dbVersion = null; // 保存数据库版本
        public static $connected = false; // 是否连接成功
        public static $PDOStatement = null; //保存PDOStatement对象
        public static $queryStr = null; // 保存最后执行的操作
        public static $error = null; // 保存错误信息
        /**
         * 连接PDO
         */
        public function __constructor($dbConfig='')
        {
            if (class_exists("PDO")) {
                self::throw_exception('不支持PDO,请先开启');
            }
            if (!is_array($dbConfig)) {
                $dbConfig = array(
                    'hostname'=>DB_HOST,
                    'username'=>DB_USER,
                    'password'=>DB_PWD,
                    'database'=>DB_NAME,
                    'hostport'=>DB_PORT,
                    'dbms'=>DB_TYPE,
                    'dsn'=>DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME
                );
            }
            if (empty($dbConfig['hostname'])) {
                self::throw_exception('没有定义数据库配置,请先定义');
            }
            self::$config = $dbConfig;
            if (empty(self::$config['params'])) {
                self::$config['params'] = array();
            }
            if (!isset(self::$link)) {
                $configs = self::$config;
                if (self::$pconnect) {
                    // 开启长连接 添加到配置数组中
                    $configs['params'][constant("PDO::ATTR_PERSISTENT")] = true;
                }
                try {
                    self::$link = new PDO($configs['dsn'], $configs['username'], $configs['password'], $configs['params']);
                } catch (PDOException $e) {
                    self::throw_exception($e->getMessage());
                }
                if (!self::$link) {
                    self::throw_exception('PDO连接错误');
                    return false;
                }
                self::$link->exec('SET NAMES '.DB_CHARSET);
                self::$dbVersion = self::$link->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
                self::$connected = true;
                unset($configs);
            }
        }
        /**
         * 得到所有记录
         */
        public static function getAll($sql=null)
        {
            if ($sql != null) {
                self::query($sql);
            }
            $result = self::$PDOStatement->fetchAll(constant("PDO::FETCH_ASSOC"));
            return $result;
        }
        /**
         * 释放结果集
         */
        public static function free() 
        {
            self::$PDOStatement = null;
        }
        /**
         * 查询
         */
        public static function query($sql='') 
        {
            $link = self::$link;
            if (!$link) {
                return false;
            }
            // 判断之前是否有结果集 如果有的话 释放结果集
            if (!empty(self::$PDOStatement)) {
                self::free();
            }
            self::$queryStr = $sql;
            // 预处理SQL语句
            self::$PDOStatement = $link->prepare(self::$queryStr);
            $res = self::$PDOStatement->execute();
            return $res;
        }
        /**
         * 有错误抛出异常
         */
        public static function haveErrorThrowException()
        {
            $obj = empty(self::$PDOStatement) ? self::$link : self::$PDOStatement;
            $arrError = $obj->errorInfo();
            // print_r($arrError);
            if ($arrError[0] != '00000') {
                self::$error = 'SQLSTATE '.$arrError[0].'SQL ERROR: ' .$arrError[2].'<br /> Error SQL: '.self::$queryStr;
                self::throw_exception(self::$error);
                return false;
            }
            if (self::$queryStr == '') {
                self::throw_exception('没有执行的SQL语句');
                return false;
            }
        }
        public static function findById()
        {
            
        }
        public static function parseGroup($group)
        {
            $groupStr = '';
            if (is_array($group)) {
                $groupStr .= ' GROUP BY' .implode(',', $group);
            } elseif (is_string($group) || !empty($group)) {
                $groupStr .= ' GROUP BY' .$group;
            }
            return empty($groupStr) ? '' : $groupStr;
        }
        public static function parseHaving()
        {
            
        }
        /**
         * 自定义错误处理
         */
        public static function throw_exception($errMsg)
        {
            echo '<div style="width=80%; background-color: #ABCDEF;color:black;font-size:20px;padding:0 20px;">
                '. $errMsg .'
            </div>';
        }
    }
    // 包含配置文件
    require_once 'config.php';
    $PdoMySQL = new PdoMySQL;
    var_dump($PdoMySQL);
    $sql = 'SELECT * FROM user';
    $PdoMySQL->getAll();
?>