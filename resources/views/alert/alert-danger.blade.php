<div class="alert alert-danger alert-dismissible" ng-if="errors.length > 0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                {{ $slot }}
</div>
      