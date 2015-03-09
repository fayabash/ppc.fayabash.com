<header class="navbar navbar-inverse ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
        </div>
        <div class="navbar-collapse collapse">
            <?php if( $is_logged ):?>
            <ul class="nav navbar-nav">
                <li><a href="http://www.pingpongclub.ch">PPC</a></li>
                <li >
                    <?php
                    echo $this->Html->link('RESERVER',array(
                        'controller' => 'pitches',
                        'action' => 'index',
                        'player' => FALSE
                    ));
                    ?>
                </li>
                <li >
                    <?php
                    echo $this->Html->link('MES RESERVATIONS',array(
                        'controller' => 'users',
                        'action' => 'bookings',
                        'player' => TRUE
                    ));
                    ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link('LOGOUT',array(
                        'controller' => 'users',
                        'action' => 'logout',
                        'player' => FALSE
                    ));
                    ?>
                </li>
            </ul>
            <?php else: ?>
            <ul class="nav navbar-nav">
                <li><a href="http://www.pingpongclub.ch">PPC</a></li>
                <li >
                    <?php
                    echo $this->Html->link('RESERVER',array(
                        'controller' => 'pitches',
                        'action' => 'index',
                        'player' => FALSE
                    ));
                    ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link('LOGIN',array(
                        'controller' => 'users',
                        'action' => 'login',
                        'player' => FALSE
                    ));
                    ?>
                </li>
            </ul>
            <?php endif;?>
        </div><!--/.navbar-collapse -->
    </div>
</header>