<?php

namespace App\GraphQL\Queries;

use App\Models\Task;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Carbon\Carbon;

class Tasks
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
        $Timezone = $context->user()->timezone;

        $Tasks  = Task::where('user_id', $UserID)->where('status', False)->whereDate('onDate', Carbon::now($Timezone))->where('deleted', False)->get();

        return $Tasks;
    }
}
