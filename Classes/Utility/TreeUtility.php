<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Utility;

class TreeUtility
{
    /**
     * @param array $array
     * @return string
     */
    public static function fromArray(array $array): string
    {
        if (empty($array)) {
            return '';
        }

        $output = '<ul class="list-tree text-monospace">';

        foreach ($array as $key => $value) {
            $output .= '<li>';

            if ($key === 'password') {
                $value = '********';
            }

            if (is_array($value)) {
                $output .= '<ul><li>' . $key . ' ' . self::fromArray($value) . '</code></li></ul>';
            } else {
                $output .= '<li>' . $key . ' = <code>' . $value . '</code></li>';
            }

            $output .= '</li>';
        }

        $output .= '</ul>';

        return $output;
    }
}
