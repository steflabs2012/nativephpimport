<?php

namespace App\Models;

class Item
{
    private \PDO   $db;
    private string $table = 'items';
    public string  $code;
    public string  $name;
    public ?string $level1          = null;
    public ?string $level2          = null;
    public ?string $level3          = null;
    public float   $price           = 0;
    public float   $price_sp        = 0;
    public int     $quantity        = 0;
    public ?string $property_fields = null;
    public int     $joint_purchases = 0;
    public ?string $unit            = null;
    public ?string $image_path      = null;
    public int     $show_on_main    = 0;
    public ?string $description     = null;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getItems()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function clearTable()
    {
        $stmt = $this->db->prepare("TRUNCATE TABLE {$this->table}");
        return $stmt->execute();
    }
    public function fillFromColumns($columns)
    {
        $this->code = trim($columns[0],'"');
        $this->name = $columns[1];
        $this->level1 = $columns[2] ?? '';
        $this->level2 = $columns[3] ?? '';
        $this->level3 = $columns[4] ?? '';
        $this->price = (float)str_replace(',', '.', $columns[5] ?? 0);
        $this->price_sp = (float)str_replace(',', '.', $columns[6] ?? 0);
        $this->quantity = (int)($columns[7] ?? 0);
        $this->property_fields = $columns[8] ?? '';
        $this->joint_purchases = !empty($columns[9]) ? 1 : 0;
        $this->unit = trim($columns[10] ?? '', '"');
        $this->image_path = $columns[11] ?? '';
        $this->show_on_main = !empty($columns[12]) ? 1 : 0;
        $this->description = $columns[13] ?? '';
    }

    public function save(): void
    {
        $sql = "INSERT INTO {$this->table}
            (code, name, level1, level2, level3, price, price_sp, quantity,
             property_fields, joint_purchases, unit, image_path, show_on_main, description)
            VALUES
            (:code, :name, :level1, :level2, :level3, :price, :price_sp, :quantity,
             :property_fields, :joint_purchases, :unit, :image_path, :show_on_main, :description)
         ";


        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([
                ':code'            => $this->code,
                ':name'            => $this->name,
                ':level1'          => $this->level1,
                ':level2'          => $this->level2,
                ':level3'          => $this->level3,
                ':price'           => $this->price,
                ':price_sp'        => $this->price_sp,
                ':quantity'        => $this->quantity,
                ':property_fields' => $this->property_fields,
                ':joint_purchases' => $this->joint_purchases,
                ':unit'            => $this->unit,
                ':image_path'      => $this->image_path,
                ':show_on_main'    => $this->show_on_main,
                ':description'     => $this->description,
            ]);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}