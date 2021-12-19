<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use \Carbon\Carbon;
use App\Models\Task;

class CreateTask
{


    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        $UserID = $context->user()->id;

        $Task               = new Task;
        $Task->task         = $args["input"]["task"];
        $Task->user_id      = $UserID;
        $Task->onDate       = Carbon::now();
        $Task->status       = false;
        $Task->save();

        return [
            "task"      => $Task->task,
            "status"    => false,
            "user_id"   => $UserID,
            "onDate"    => $Task->onDate
        ];
    }
}