<?php

const FLASH = 'FLASH_MESSAGES';
const FLASH_SUCCESS = 'success';
const FLASH_ERROR = 'danger';

function create_flash_message(string $name, string $message, string $type): void
{
  // remove existing message with the name
  if (isset($_SESSION[FLASH][$name])) {
    unset($_SESSION[FLASH][$name]);
  }
  // add the message to the session
  $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

function format_flash_message(array $flash_message): string
{
  return sprintf(
    '<div class="alert alert-%s">
      <div class="message">%s</div>
      <div class="close">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
        </svg>
      </div>
    </div>',
    $flash_message['type'],
    $flash_message['message']
  );
}

function display_flash_message(string $name): void
{
  if (!isset($_SESSION[FLASH][$name])) {
    return;
  }

  // get message from the session
  $flash_message = $_SESSION[FLASH][$name];

  // delete the flash message
  unset($_SESSION[FLASH][$name]);

  // display the flash message
  echo format_flash_message($flash_message);
}

function display_all_flash_messages(): void
{
  if (!isset($_SESSION[FLASH])) {
    return;
  }

  // get flash messages
  $flash_messages = $_SESSION[FLASH];

  // remove all the flash messages
  unset($_SESSION[FLASH]);

  // show all flash messages
  foreach ($flash_messages as $flash_message) {
    echo format_flash_message($flash_message);
  }
}

function flash(string $name = '', string $message = '', string $type = '', string $link = ''): void
{
  if ($name !== '' && $message !== '' && $type !== '' && $link === '') {
    // create a flash message
    create_flash_message($name, $message, $type);
  } elseif ($name !== '' && $message !== '' && $type !== '' && $link !== '') {
    // create a flash message with redirect to other page
    create_flash_message($name, $message, $type);
    header("Location: " . $link);
  } elseif ($name !== '' && $message === '' && $type === '' && $link === '') {
    // display a flash message
    display_flash_message($name);
  } elseif ($name === '' && $message === '' && $type === '' && $link === '') {
    // display all flash message
    display_all_flash_messages();
  }
}
