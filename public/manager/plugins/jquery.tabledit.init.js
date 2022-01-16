/**
 * Theme: Metrica - Responsive Bootstrap 4 Admin Dashboard
 * Author: Mannatthemes
 * Tabledit Js
 */


 
$('#my-table').Tabledit({
  columns: {
  identifier: [0, 'id'],                    
  editable: [[2, 'col1'], [3, 'col1'], [4, 'col3']]
  }
});
$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();