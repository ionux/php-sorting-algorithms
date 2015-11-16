<?php
/******************************************************************************
 * This file is part of the PHP Sorting Algorithms project. You can always find
 * the latest version of this class and project at:
 * https://github.com/ionux/php-sorting-algorithms
 *
 * Copyright (c) 2015 Rich Morgan, rich@richmorgan.me
 *
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ******************************************************************************/

/**
 * Abstract utility class with examples of several classic sorting algorithms. These
 * were based on the originals by Richard Knop: http://blog.richardknop.com/category/algorithms/.
 * These examples are presented here in the hopes that new & inexperienced PHP developers
 * can learn more about these classic Computer Science algorithms.  Also, the whole class
 * demonstrates good coding style, OO concepts and is an example of code that adheres to
 * the PSR-2 Coding Style Guide: http://www.php-fig.org/psr/psr-2/.
 *
 * @author Rich Morgan <rich@richmorgan.me>
 */
class Sort
{

    /**
     * Bubble sort is a simple sorting algorithm. The algorithm starts at the
     * beginning of the data set. It compares the first two elements, and if
     * the first is greater than the second, it swaps them. It continues doing
     * this for each pair of adjacent elements to the end of the data set. It
     * then starts again with the first two elements, repeating until no swaps
     * have occurred on the last pass. This algorithm's average and worst-case
     * performance is O(n2), so it is rarely used to sort large, unordered data
     * sets. Bubble sort can be used to sort a small number of items (where its
     * asymptotic inefficiency is not a high penalty). Bubble sort can also be
     * used efficiently on a list of any length that is nearly sorted (that is,
     * the elements are not significantly out of place). For example, if any
     * number of elements are out of place by only one position (e.g. 0123546789
     * and 1032547698), bubble sort's exchange will get them in order on the
     * first pass, the second pass will find all elements in order, so the sort
     * will take only 2n time.
     * 
     * @see: https://en.wikipedia.org/wiki/Sorting_algorithm#Bubble_sort_and_variants
     * 
     * @param  array  $unsortedArray  The unsorted array that you'd like to sort.
     * @return array  $sortedArray    The sorted array of values.
     */
    public function bubbleSort(array $unsortedArray) {
        if (empty($unsortedArray) || count($unsortedArray) == 1) {
            return $unsortedArray;
        }

        $sorted      = false;
        $sortedArray = array();
        $currentItem = '';
        $nextItem    = '';

        $forLoopBounds = count($unsortedArray) - 1;
        $sortedArray   = $unsortedArray;
        
        while ($sorted === false) {
            $sorted = true;

            for ($i = 0; $i < $forLoopBounds; ++$i) {
                $current = $sortedArray[$i];
                $next    = $sortedArray[$i+1];

                if ($next < $current) {
                    $sortedArray[$i]   = $next;
                    $sortedArray[$i+1] = $current;

                    $sorted = false;
                }
            }
        }

        return $sortedArray;
    }

    /**
     * Merge sort takes advantage of the ease of merging already sorted lists
     * into a new sorted list. It starts by comparing every two elements (i.e.,
     * 1 with 2, then 3 with 4...) and swapping them if the first should come
     * after the second. It then merges each of the resulting lists of two into
     * lists of four, then merges those lists of four, and so on; until at last
     * two lists are merged into the final sorted list.  Of the algorithms
     * described here, this is the first that scales well to very large lists,
     * because its worst-case running time is O(n log n). It is also easily
     * applied to lists, not only arrays, as it only requires sequential access,
     * not random access. However, it has additional O(n) space complexity, and
     * involves a large number of copies in simple implementations.
     * 
     * Merge sort has seen a relatively recent surge in popularity for practical
     * implementations, due to its use in the sophisticated algorithm Timsort,
     * which is used for the standard sort routine in the programming languages
     * Python and Java (as of JDK 7). Merge sort itself is the standard routine
     * in Perl, among others, and has been used in Java at least since 2000 in
     * JDK 1.3.
     *
     * @see: https://en.wikipedia.org/wiki/Sorting_algorithm#Merge_sort
     *
     * @param  array  $unsortedArray  The unsorted array that you'd like to sort.
     * @return array  $result         The sorted array of values.
     */
    public function mergeSort(array $unsortedArray) {
        if (empty($unsortedArray) || count($unsortedArray) == 1) {
            return $unsortedArray;
        }

        $left   = array();
        $right  = array();
        $result = array();

        $middle = round(count($unsortedArray) / 2);

        for ($i = 0; $i < $middle; ++$i) {
            $left[] = $unsortedArray[$i];
        }

        $forLoopBounds = count($unsortedArray);

        for ($i = $middle; $i < $forLoopBounds; ++$i) {
            $right[] = $unsortedArray[$i];
        }

        $left  = mergeSort($left);
        $right = mergeSort($right);

        while (count($left) > 0 || count($right) > 0) {
            if (count($left) > 0 && count($right) > 0) {
                $firstLeft  = current($left);
                $firstRight = current($right);

                if ($firstLeft <= $firstRight) {
                    $result[] = array_shift($left);
                } else {
                    $result[] = array_shift($right);
                }
            } else if (count($left) > 0) {
                $result[] = array_shift($left);
            } else if (count($right) > 0) {
                $result[] = array_shift($right);
            }
        }

        return $result;
    }
}
