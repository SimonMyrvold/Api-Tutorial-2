<?php

namespace App\Filter;

use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Operator;

class ApiFilter {

     protected $safeParms = [

     ];

     protected $columnMap = [

     ];

     protected $operatorMap = [

     ];

     public function transfrom(Request $request){
        $eloQuery = [];

        foreach($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
     }
}