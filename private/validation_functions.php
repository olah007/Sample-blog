<?php
  // * validate data presence
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // Check uniqueness of post topic
  function has_unique_post_topic($topic, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE topic='" . db_escape($db, $topic) . "' ";
    $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

    $post_set = mysqli_query($db, $sql);
    $post_count = mysqli_num_rows($post_set);
    mysqli_free_result($post_set);

    return $post_count === 0;
  }
?>
