<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility;

use Exception;
use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

/**
 * @see https://github.com/webonyx/graphql-php/blob/master/examples/00-hello-world/graphql.php
 */
class GraphQueryLanguageService
{
    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function main(): void
    {
        try {
            $queryType = new ObjectType(
                [
                    'name' => 'Query',
                    'fields' => [
                        'echo' => [
                            'type' => Type::string(),
                            'args' => [
                                'message' => ['type' => Type::string()],
                            ],
                            'resolve' => static function ($rootValue, $args): string {
                                return $rootValue['prefix'] . $args['message'];
                            }
                        ],
                    ],
                ]
            );
            $mutationType = new ObjectType(
                [
                    'name' => 'Calc',
                    'fields' => [
                        'sum' => [
                            'type' => Type::int(),
                            'args' => [
                                'x' => ['type' => Type::int()],
                                'y' => ['type' => Type::int()],
                            ],
                            // @phan-suppress-next-line PhanUnusedClosureParameter
                            'resolve' => static function ($calc, $args): int {
                                return (int)($args['x'] + $args['y']);
                            },
                        ],
                    ],
                ]
            );
            // See docs on schema options:
            // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
            $schema = new Schema(
                [
                    'query' => $queryType,
                    'mutation' => $mutationType,
                ]
            );
            $rawInput = file_get_contents('php://input');

            if ($rawInput === false) {
                throw new FrameworkException('Could not read php://input.');
            }

            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;
            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (Exception $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($output);
    }
}
