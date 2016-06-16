<?php

class Orders extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        
        // Make sure the user is signed in
        if ( !$this->ion_auth->logged_in() )
        {
            redirect('auth/login', 'refresh');
        }
    }
    
    /**
     * Create a new order for a combat command
     */
    function create($command_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('ordermodel');
        $this->load->model('commandmodel');
        
        $command = $this->commandmodel->get_by_id($command_id);
        validate_exists($command->command_id, 'No such command.', 'home/dashboard');
        
        // Validate form input
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['command'] = $command;
            $page['orders'] = $this->ordermodel->get_by_command($command_id);
            $page['content'] = 'order_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new order
            $order = new stdClass();
            $order->type = $this->input->post('type');
            $order->game_id   = $command->game_id;
            $order->command_id = $command_id;
            $order->notes = $this->input->post('note');
            
            // Order Points
            $order->points = 1;
            if ($order->type == 'Train')
            {
                $order->points = 3;
            }
            else if ($order->type == 'Rest' || $order->type == 'Repair')
            {
                $order->points = 2;
            }
            
            // RP Cost
            if ($order->type == 'Move' || $order->type == 'Assault')
            {
                $order->rp_cost = 4;
            }
            if ($order->type == 'Fortify')
            {
                $order->rp_cost = 6;
            }
            
            $this->ordermodel->create($order);
            
            $this->session->set_flashdata('notice', 'Order created.');
            redirect('command/view/'.$command_id, 'refresh');
        }
    }
    
    /**
     * Delete an order
     */
    function delete($command_id=0, $order_id=0)
    {
        $page = $this->page;
        
        // Command and orders must exist
        $this->load->model('commandmodel');        
        $command = $this->commandmodel->get_by_id($command_id);
        validate_exists($command->command_id, 'No such command.', 'home/dashboard');
        
        $this->load->model('ordermodel');
        $order = $this->ordermodel->get_by_id($order_id);
        validate_exists($order->order_id, 'No such order.', 'command/view/'.$command_id);
        
        // Must be playing on the commands faction and have permission
        $this->load->model('gamemodel');
        $game = $this->gamemodel->get_by_id($command->game_id);
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_user_game($page['user']->id, $game->game_id);
        validate_matches($command->faction_id, $player->faction_id, 'Not authorized.', 'game/view/'.$game->game_id);
        
        $this->load->model('ordermodel');
        $this->ordermodel->delete($order_id);
        $this->session->set_flashdata('notice', 'Order deleted.');
        redirect('command/view/'.$command_id, 'refresh');
    }
    
    /**
     * Delete all orders in a game
     */
    function clear($game_id=0)
    {
        $page = $this->page;        

        $this->load->model('ordermodel');
        $this->ordermodel->clear($game_id);
        $this->session->set_flashdata('notice', 'Orders cleared.');
        redirect('game/view/'.$game_id, 'refresh');
    }
    
}
