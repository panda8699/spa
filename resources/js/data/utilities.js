import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2';

export const confirmSwal = async ({title}) => {
    return await Swal.fire({
        title: title,
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#e21ab5',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        iconColor: '#e21ab5'
      }).then((result) => {
        return result
      })
}

export const confirmcancleSwal = async ({title,subtitle}) => {
    return await Swal.fire({
        title: title,
        html: subtitle, 
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#e21ab5',
        cancelButtonColor: '#858482',
        confirmButtonText: 'Confirm',
        iconColor: '#e21ab5'
      }).then((result) => {
        return result
      })
}

export const confirmcancleWallet = async ({title}) => {
  return await Swal.fire({
      title: title,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e21ab5',
      cancelButtonColor: '#858482',
      confirmButtonText: 'Confirm',
      iconColor: '#e21ab5'
    }).then((result) => {
      return result
    })
}
