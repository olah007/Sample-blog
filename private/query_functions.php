<?php

// CATEGORIES
  function find_all_categories () {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "ORDER BY date_created ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_category_by_id($id) {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category;  //returns an assoc. array
}


//POSTS

  function find_all_posts() {
    global $db;

    $sql = "SELECT * FROM posts ";
    $sql .= "ORDER BY date_created ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_post_by_id($id) {
    global $db;

    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $post = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $post;  //returns an assoc. array
  }

  function validate_post($post) {

    $errors = [];

    // cat_id
    if(is_blank($post['cat_id'])) {
        $errors[] = "Category cannot be blank.";
    } 
    
    // topic
    if(is_blank($post['topic'])) {
      $errors[] = "Topic cannot be blank.";
    } elseif(!has_length($post['topic'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Topic must be between 2 and 255 characters.";
    }
    $current_id = $post['id'] ?? '0';
    if(!has_unique_post_topic($post['topic'], $current_id)) {
        $errors[] = "Topic must be unique.";
    }

    // body
    if(is_blank($post['body'])) {
        $errors[] = "Body cannot be blank.";
    } 

    return $errors;
  }

  function insert_post($post) {
    global $db;

    $errors = validate_post($post);
    if(!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO posts ";
    $sql .= "(cat_id, topic, body) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $post['cat_id']) . "',";
    $sql .= "'" . db_escape($db, $post['topic']) . "',";
    $sql .= "'" . db_escape($db, $post['body']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    //For INSERT statements, $result is true/false
    if($result) {
        return true;
    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
  }

  function update_post($post) {
    global $db;

    $errors = validate_post($post);
    if(!empty($errors)) {
        return $errors;
    } 

    $sql = "UPDATE posts SET ";
    $sql .= "cat_id='" .  db_escape($db, $post['cat_id']) . "', ";
    $sql .= "topic='" .  db_escape($db, $post['topic'])  . "', ";
    $sql .= "body='" .  db_escape($db, $post['body']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $post['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
        return true;
    } else {
        //UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
  }

  function delete_post($id) {
    global $db;

    $sql = "DELETE FROM posts ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    //For DELETE statements, $result is true/false
    if($result) {
        return true;
    } else {
        //DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
  }


// ADMINS
  function find_admin_by_email($email) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  } 

?>