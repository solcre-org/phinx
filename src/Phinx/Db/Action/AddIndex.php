<?php
/**
 * Phinx
 *
 * (The MIT license)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated * documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */
namespace Phinx\Db\Action;

use InvalidArgumentException;
use Phinx\Db\Table\Index;
use Phinx\Db\Table\Table;

class AddIndex extends Action
{
    protected $index;

    public function __construct(Table $table, Index $index)
    {
        $this->table = $table;
        $this->index = $index;
    }

    public static function build(Table $table, $columns, array $options = [])
    {
        // create a new index object if strings or an array of strings were supplied
        $index = $columns;

        if (!$columns instanceof Index) {
            $index = new Index();

            if (is_string($columns)) {
                $columns = [$columns]; // str to array
            }

            $index->setColumns($columns);
            $index->setOptions($options);
        }

        return new static($table, $index);
    }

    public function getIndex()
    {
        return $this->index;
    }
}
