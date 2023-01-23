<?php

        $items = array("John Smith", "Jon Smith", "Juan Smith", "Jackie Smith", "Jim Smith", "Jane Smith", "Jake Smith", "Julia Smith", "Jasmine Smith", "Justin Smith", "Josh Smith", "Jenna Smith", "Joel Smith", "Jordan Smith", "Jasmine Smith", "Jenna Smith", "Jasmine Smith", "Jenna Smith", "Jasmine Smith", "Jenna Smith", "Jasmine Smith", "Jenna Smith", "Jasmine Smith", "Jenna Smith", "Jasmine Smith", "Jenna Smith", "Jasmine Smith", "Jenna Smith");
        
        $search = "John Smith";
        $results = array();
        $threshold = 0.8;
        $whitelist = array("John Smith", "Jenna Smith", "Julia Smith");
        foreach ($items as $item) {
            if(in_array($item, $whitelist)){
                continue;
            }
            $item_soundex = soundex($item);
            $search_soundex = soundex($search);
            if ($item_soundex == $search_soundex) {
                similar_text($search, $item, $percent);
                $levenshtein_distance = levenshtein($search, $item);
                //$jaro_winkler_distance = jaro_winkler($search, $item);
                //$damerau_levenshtein_distance = damerau_levenshtein($search, $item);
                //$jaccard_similarity = jaccard_similarity($search, $item);
                //$cosine_similarity = cosine_similarity($search, $item);
                //$sorensen_dice_similarity = sorensen_dice_similarity($search, $item);
                $adaptive_threshold = $threshold - ($levenshtein_distance * 0.05);
                if($percent >= $adaptive_threshold){
                    $results[$item] = array("similarity_score" => $percent, "levenshtein_distance" => $levenshtein_distance, );
                }
            }
        }
        
        //sort results by trust score
        arsort($results);
        // show the top 5 most similar results
        print_r(array_slice($results, 0, 5, true));

?>
