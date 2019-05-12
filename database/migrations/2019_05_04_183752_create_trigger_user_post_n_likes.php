<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerUserPostNLikes extends Migration
{
    /**
     * Run the migrations.
     * After insertion. Add one or dont do anything
     * After Update. Add one or delete
     * After Delete. Delete one or dont do anything
     * @return void
     */
    public function up()
    {

      //INSERTION
      BD::unprepared('
        CREATE TRIGGER user_post_n_likes
        AFTER INSERT ON `likes`
        BEGIN
          UPDATE posts
          SET posts.likes = (Select likes + 1 FROM posts where posts.id = NEW.post_id)
          WHERE NEW.post_id = posts.id
        END
      ');

      BD::unprepared('
        CREATE TRIGGER user_post_n_likes
        AFTER INSERT ON `likes`
        BEGIN
          DECLARE new_likes integer;
          values = SELECT likes FROM



          IF NEW.like

          ELSE

          END IF;

          UPDATE post
          SET post.likes =

        END
      ');

      BD::unprepared('
        CREATE TRIGGER user_post_n_likes
        AFTER INSERT ON `likes`
        BEGIN
          DECLARE new_likes integer;
          values = SELECT likes FROM



          IF NEW.like

          ELSE

          END IF;

          UPDATE post
          SET post.likes =

        END
      ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger_user_post_n_likes');
    }
}
