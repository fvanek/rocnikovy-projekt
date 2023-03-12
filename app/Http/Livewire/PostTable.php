<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class PostTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {
        return Post::query()->join('users', 'users.id', '=', 'posts.user_id')
            ->join('subforums', 'subforums.id', '=', 'posts.subforum_id')
            ->select('posts.*', 'users.name as user_name', 'subforums.name as subforum_name')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('title')
            ->addColumn('user_name')
            ->addColumn('subforum_name')
            ->addColumn('created_at_formatted', function (Post $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y');
            })
            ->addColumn('zobrazit', function (Post $model) {
                return '<a href="' . route('post', $model->id) . '" class="btn btn-primary btn-sm">Zobrazit</a>';
            });

    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |

    */
     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('NÁZEV', 'title')
                ->sortable()
                ->searchable(),

            Column::make('AUTOR', 'user_name')
                ->sortable()
                ->searchable(),

            Column::make('SUBFORUM', 'subforum_name')
                ->sortable()
                ->searchable(),

            Column::make('VYTVOŘENO', 'created_at_formatted')
                ->sortable()
                ->searchable(),

            Column::make('ZOBRAZIT', 'zobrazit')
        ];
    }
}
