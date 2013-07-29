<h1 style ="font-size: 24px;">Edit Channels</h1>
   <?php
      echo $this->Form->create('Channel', array('action' => 'edit'));
      echo $this->Form->input('title');
      echo $this->Form->end('Save Channel');
   ?>


