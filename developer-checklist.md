<h1>Checklist - for new controllers/resources -</h1>

## Views

- Breadcrumbs ( Last item without link) remove < a >
- index (table table-hover ajaxTable) & show (table table-bordered) table styles and add (table-responsive) to parent div
- pageTitle in view files should be like following: 
Index: @section('pageTitle', trans('cruds.permission.title') . ' | ' . trans('panel.site_title'))
Show: @section('pageTitle', sprintf('%s| %s %s', $permission->name, trans('global.show'), trans('cruds.permission.title_singular')) . ' | ' . trans('panel.site_title'))
Edit: @section('pageTitle', sprintf('%s | %s %s', $permission->name, trans('global.edit'), trans('cruds.permission.title_singular')) . ' | ' . trans('panel.site_title'))
Create: @section('pageTitle', sprintf('%s %s', trans('global.create'), trans('cruds.permission.title_singular')) . ' | ' . trans('panel.site_title'))
- Menu and active item check
- Change label class in forms: (form-label)
- Make one form file for edit & create
- Select & Unselect all buttons have to be below dropdown list and outline btn style
- Make sure to add msg after save/delete
- Remove Back to list top btn in show view and replace with main field as h3 - remember to remove that field from details table -
- Option display as badge-info in show view
- All displayed texts/labels whould use trans()

## Controllers

- In controller file, remove extra columns or add with to load relationships
