<?php
/**
 * Класс взаимодействия какой-либо сущности с базой данных
 */
abstract class Entity
{
    /**
     * объект соединения с БД
     * @var PDO
     */
    protected $db; //Объект PDO
    

    /**
     * @param PDO $connection объект соединения с БД
     */
    function __construct(\PDO $connection)
    {
        $this->db=$connection;
    }

    /**
     * Добавление новой строки в таблицу
     * @param object $object сущность, данные из которой нужно поместить в таблицу
     * @return boolean статус добавления
     */
    abstract public function add(Model $object);

    /**
     * Удаление строки из таблицы
     * @param int $id значение поля id удаляемой строки
     * @return boolean статус удаления
     */
    public function delete(int $id){}
}