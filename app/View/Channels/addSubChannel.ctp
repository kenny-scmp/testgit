  <h1>Edit Channel</h1>
   <?php
      echo $this->Form->create('Channel', array('action' => 'edit'));
      echo $this->Form->input('title');
      echo $this->Form->end('Save Channel');
   ?>


