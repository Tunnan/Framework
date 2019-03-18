<?php

class WelcomeController
{
  public function index()
  {
    // To send data to the view
    // new View('welcome.index', ['name' => 'Your Name']);

    // For use of another template:
    // return (new View('welcome.index'))->template('your-template');

    return new View('welcome.index', [
      'name' => 'World'
    ]);
  }

  // The basic methods for CRUD functionality:
  // public function index() { // .. }
  // public function create() { // .. }
  // public function store() { // .. }
  // public function show($id) { // .. }
  // public function edit($id) { // .. }
  // public function update($id) { // .. }
  // public function destoy($id) { // .. }
}
