<?php

namespace App\Enums;

enum UserRoleEnum:string {
  case User = 'user';
  case SecretAgent = 'secretagent';
}